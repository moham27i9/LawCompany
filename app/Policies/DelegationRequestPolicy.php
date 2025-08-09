<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DelegationRequest;
use App\Models\Lawyer;

class DelegationRequestPolicy
{
    /**
     * من يمكنه الموافقة أو الرفض → الأدمن فقط
     */
    public function approve(User $user)
    {
        return $user->role && $user->role->name === 'admin';
    }

    /**
     * المحامي الذي قدّم الطلب يجب أن يكون مرتبطاً فعلياً بالجلسة
     */
    public function create(User $user, $session)
    {
        if (!$user->lawyer) {
            return false;
        }

        // التحقق من أن المحامي الحالي مرتبط بهذه الجلسة
        return $session->lawyer_id === $user->lawyer->id;
    }

    /**
     * المحامي النائب يجب أن يكون مسنداً للقضية
     */
  public function assignDelegate(User $user, DelegationRequest $delegation, $delegateLawyerId)
    {
        // السماح فقط للأدمن
        if (!$user->role || $user->role->name !== 'admin') {
            return false;
        }

        // إذا لم يتم تمرير محامي نائب أو كان null نرفض
        if (empty($delegateLawyerId)) {
            return false;
        }

        // جلب جميع المحامين المرتبطين بالقضية
        $caseLawyers = $delegation->session->issue->lawyers()->pluck('lawyers.id')->toArray();
        // تحقق أن المحامي النائب موجود ضمن المحامين المسندين للقضية
        return in_array($delegateLawyerId, $caseLawyers);
    }


    /**
     * الحذف → الأدمن أو مقدم الطلب
     */
    public function delete(User $user, DelegationRequest $delegation)
    {
        return $user->role->name === 'admin'
            || ($user->lawyer && $delegation->original_lawyer_id === $user->lawyer->id);
    }

    /**
     * التعديل → مقدم الطلب فقط
     */
    public function update(User $user, DelegationRequest $delegation)
    {
        return $user->lawyer && $delegation->original_lawyer_id === $user->lawyer->id;
    }

    /**
     * العرض → الأدمن أو المحامي مقدم الطلب أو المحامي النائب
     */
    public function view(User $user, DelegationRequest $delegation)
    {
        return $user->role->name === 'admin'
            || ($user->lawyer && (
                $delegation->original_lawyer_id === $user->lawyer->id
                || $delegation->delegate_lawyer_id === $user->lawyer->id
            ));
    }

    /**
     * عرض الكل → الأدمن فقط
     */
    public function viewAny(User $user)
    {
        return $user->role->name === 'admin';
    }
}
