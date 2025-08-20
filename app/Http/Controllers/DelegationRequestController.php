<?php

namespace App\Http\Controllers;

use App\Http\Requests\DelegationRequestFormRequest;
use App\Models\DelegationRequest;
use App\Models\Lawyer;
use App\Models\Sessionss;
use App\Notifications\GeneralNotification;
use App\Services\DelegationRequestService;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DelegationRequestController extends Controller
{
    protected $service;
     use ApiResponseTrait;
    use AuthorizesRequests;
    public function __construct(DelegationRequestService $service)
    {
        $this->service = $service;
    }

   public function submit(DelegationRequestFormRequest $request, $session_id)
    {
        $data = $request->validated();
      $session = Sessionss::findOrFail($session_id);
      $this->authorize('create', [DelegationRequest::class, $session]);
        $result = $this->service->submitRequest($data, $session_id);
        return $this->successResponse($result, 'تم رفع طلب الإنابة بنجاح');
    }

    public function update(DelegationRequestFormRequest $request, $id)
    {
          $delegation = $this->service->getRequestById($id);
          $this->authorize('update', $delegation);
        $data = $request->validated();
        $result = $this->service->updateRequest($id, $data);
        return $this->successResponse($result, 'تم تعديل طلب الإنابة بنجاح');
    }

    public function destroy($id)
    {
            $delegation = $this->service->getRequestById($id);
            $this->authorize('delete', $delegation);
        $this->service->deleteRequest($id);
        return $this->successResponse(null, 'تم حذف طلب الإنابة بنجاح');
    }

    public function show($id)
    {
           $delegation = $this->service->getRequestById($id);
         $this->authorize('view', $delegation);
        $result = $this->service->getRequestById($id);
        return $this->successResponse($result, 'تم جلب طلب الإنابة بنجاح');
    }

    public function index()
    {
       
        $result = $this->service->getAllRequests();
          $this->authorize('approve',DelegationRequest::class);
        return $this->successResponse($result, 'تم جلب جميع طلبات الإنابة');
    }


 public function approve(Request $request, $id)
{
    $data = $request->validate([
        'delegate_lawyer_id' => 'required|exists:lawyers,id',
        'admin_note' => 'nullable|string'
    ]);
   $delegation = $this->service->getRequestById($id);
   $this->authorize('approve', DelegationRequest::class);
  $this->authorize('assignDelegate', [$delegation, $data['delegate_lawyer_id']]);
  
    // الموافقة على الطلب
    $result = $this->service->approveRequest($id, $data);
    // جلب المحامي الأصلي
    $originalLawyer = Lawyer::with('user')->findOrFail($result->original_lawyer_id);

    // جلب المحامي النائب
    $delegateLawyer = Lawyer::with('user')->findOrFail($data['delegate_lawyer_id']);
     //تحديث المحامي في الجلسة
      $session = Sessionss::findOrFail($result->session_id);
      $session->update([
        'lawyer_id' =>$data['delegate_lawyer_id']
      ]);
      $session->save();

    // إرسال إشعار للمحامي الأصلي
    if ($originalLawyer->user) {
        $originalLawyer->user->notify(
            new GeneralNotification(
                'تم قبول طلب الإنابة',
                $data['admin_note'] ?? 'تم تعيين محامي آخر لينوب عنك',
                '/delegations/' . $id
            )
        );
    }

    // إرسال إشعار للمحامي النائب
    if ($delegateLawyer->user) {
        $delegateLawyer->user->notify(
            new GeneralNotification(
                'طلب إنابة',
                $data['admin_note'] ?? 'تم تعيينك للإنابة عن محامي آخر',
                '/delegations/' . $id
            )
        );
    }

        return $this->successResponse($result, 'تمت الموافقة على طلب الإنابة');
}

    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'nullable|string'
        ]);

           $this->authorize('approve', DelegationRequest::class); 
        $result = $this->service->rejectRequest($id, $request->admin_note);
        if($result){

            $originalLawyer = Lawyer::with('user')->findOrFail($result->original_lawyer_id);
            // إرسال إشعار للمحامي الأصلي
            if ($originalLawyer->user) {
                $originalLawyer->user->notify(
                    new GeneralNotification(
                        'تم رفض طلب الإنابة',
                        $data['admin_note'] ?? 'تم رفض طلبك',
                        '/delegations/' . $id
                        )
                    );
                }
                return $this->successResponse($result, 'تم رفض طلب الإنابة');
            }
              return $this->errorResponse('الطلب بحالة قبول أو رفض لا يمكن التغيير');
    }
}
