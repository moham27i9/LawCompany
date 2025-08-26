<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Permission|null $permission
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppRoute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAppRoute {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $date
 * @property string|null $resault
 * @property int $issue_id
 * @property int $lawyer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Issue $issue
 * @property-read \App\Models\Lawyer $lawyer
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereIssueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereResault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAttendDemand {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommonConsultation whereViews($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCommonConsultation {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property \Illuminate\Support\Carbon $foundation_date
 * @property string $description
 * @property string $goals
 * @property string $vision
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereFoundationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyInfo whereVision($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCompanyInfo {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $description
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperComplaint {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $resault
 * @property int $lawyer_id
 * @property int $consultation_req_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ConsultationRequest|null $consultationRequests
 * @property-read \App\Models\Lawyer $lawyer
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereConsultationReqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereResault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperConsultation {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $subject
 * @property string|null $details
 * @property int $is_locked
 * @property int|null $locked_by
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Consultation|null $consultation
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereLockedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultationRequest whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperConsultationRequest {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $session_id
 * @property int $original_lawyer_id
 * @property int|null $delegate_lawyer_id
 * @property string $status
 * @property string|null $admin_note
 * @property string|null $delegation_file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lawyer|null $delegateLawyer
 * @property-read \App\Models\Lawyer $originalLawyer
 * @property-read \App\Models\Sessionss $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereDelegateLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereDelegationFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereOriginalLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DelegationRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperDelegationRequest {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $session_id
 * @property string $file
 * @property string $privacy
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sessionss $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document wherePrivacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperDocument {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $salary
 * @property string|null $certificate
 * @property string $hire_date
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HiringRequest> $hiringRequest
 * @property-read int|null $hiring_request_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FurLoughRequest> $leaves
 * @property-read int|null $leaves_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payroll> $payroll
 * @property-read int|null $payroll_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Report> $reports
 * @property-read int|null $reports_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payroll> $payrolls
 * @property-read int|null $payrolls_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalaryAdjustment> $salaryAdjustments
 * @property-read int|null $salary_adjustments_count
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEmployee {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $description
 * @property string $amount
 * @property string $type
 * @property int|null $related_id
 * @property string|null $related_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $related
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereRelatedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperExpense {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property string $cause
 * @property string $status
 * @property string $covet_by_type
 * @property int $covet_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $covet_by
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereCause($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereCovetById($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereCovetByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurloughRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperFurloughRequest {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $jopTitle
 * @property string $type
 * @property string $description
 * @property string $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplication> $jobApplication
 * @property-read int|null $job_application_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereJopTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperHiringRequest {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $date
 * @property int $jobApp_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JobApplication|null $jobApplication
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereJobAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereUpdatedAt($value)
 * @property string $result
 * @property string|null $note
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereResult($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperInterview {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property float $amount
 * @property string $status
 * @property int $issue_id
 * @property int $user_id
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @property-read \App\Models\Issue $issue
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereIssueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUserId($value)
 * @property string|null $creator_type
 * @property int|null $creator_id
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $creator
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCreatorType($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperInvoice {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $issue_number
 * @property string|null $opponent_name
 * @property string $court_name
 * @property int $number_of_payments
 * @property string|null $total_cost
 * @property int $lawyer_percentage
 * @property string $amount_paid
 * @property string|null $description
 * @property int $user_id
 * @property string $status
 * @property string $priority
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendDemand> $attend_demand
 * @property-read int|null $attend_demand_count
 * @property-read \App\Models\IssueCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lawyer> $lawyers
 * @property-read int|null $lawyers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sessionss> $sessions
 * @property-read int|null $sessions_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereCourtName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereIssueNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereLawyerPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereNumberOfPayments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereOpponentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperIssue {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, IssueCategory> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Issue> $issues
 * @property-read int|null $issues_count
 * @property-read IssueCategory|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperIssueCategory {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $report
 * @property int $pre_session_count
 * @property int $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Session $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport wherePreSessionCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperIssueProgressReport {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property int $is_locked
 * @property string $status
 * @property string|null $admin_note
 * @property string|null $scheduled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueRequest whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperIssueRequest {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $HirReq_id
 * @property string $cv
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HiringRequest|null $hiringRequest
 * @property-read \App\Models\Interview|null $interview
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereCv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereHirReqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUserId($value)
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereStatus($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperJobApplication {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $license_number
 * @property float $experience_years
 * @property string $salary
 * @property string|null $certificate
 * @property string $type
 * @property string $specialization
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendDemand> $attend_demand
 * @property-read int|null $attend_demand_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DelegationRequest> $delegationRequestsReceived
 * @property-read int|null $delegation_requests_received_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DelegationRequest> $delegationRequestsSent
 * @property-read int|null $delegation_requests_sent_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Issue> $issues
 * @property-read int|null $issues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FurloughRequest> $leaves
 * @property-read int|null $leaves_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payroll> $payrolls
 * @property-read int|null $payrolls_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LawyerPoint> $points
 * @property-read int|null $points_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalaryAdjustment> $salaryAdjustments
 * @property-read int|null $salary_adjustments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sessionss> $sessions
 * @property-read int|null $sessions_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereExperienceYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLawyer {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $lawyer_id
 * @property int $points
 * @property string $source
 * @property string|null $notes
 * @property int|null $session_id
 * @property int|null $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $admin
 * @property-read \App\Models\Lawyer $lawyer
 * @property-read \App\Models\Sessionss|null $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LawyerPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLawyerPoint {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $bookTitle
 * @property string $book
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavedLegalBook> $SavedLegalBook
 * @property-read int|null $saved_legal_book_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereBookTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLegalBook {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavedLegalNews> $savedLegalNews
 * @property-read int|null $saved_legal_news_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLegalNews {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $message
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $receiver
 * @property-read \App\Models\User $sender
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperMessage {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property float $payment
 * @property string $allowances
 * @property string $deductions
 * @property string $status
 * @property int $payable_id
 * @property string $payable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Expense> $expenses
 * @property-read int|null $expenses_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll whereAllowances($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll whereDeductions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll wherePayableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll wherePayableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payroll whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPayroll {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $app_route_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\AppRoute|null $route
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereAppRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPermission {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $address
 * @property string $phone
 * @property string|null $scientificLevel
 * @property int $age
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereScientificLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUserId($value)
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereImage($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProfile {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RefreshToken whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRefreshToken {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property int $employee_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereUpdatedAt($value)
 * @property string $file_path
 * @property string $total_amount
 * @property string $report_date
 * @property string|null $notes
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereReportDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereTotalAmount($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperReport {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $issue_id
 * @property string $require_file_type
 * @property string|null $file
 * @property string $status
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Issue $issue
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereIssueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereRequireFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequiredDocument whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRequiredDocument {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $employable_type
 * @property int $employable_id
 * @property string $type
 * @property string|null $reason
 * @property string $amount
 * @property int $processed
 * @property string $effective_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $employable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereEffectiveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereEmployableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereEmployableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryAdjustment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSalaryAdjustment {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $legalbook_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereLegalbookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereUserId($value)
 * @property-read \App\Models\LegalBook $legalBook
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSavedLegalBook {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $legalNews_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereLegalNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereUserId($value)
 * @property-read \App\Models\LegalNews $legalNew
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSavedLegalNews {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $date
 * @property int $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Session $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereUpdatedAt($value)
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereType($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSessionAppointment {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property int $points
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sessionss> $sessions
 * @property-read int|null $sessions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSessionType {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $outcome
 * @property int $is_attend
 * @property int $issue_id
 * @property int $lawyer_id
 * @property int $session_type_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SessionAppointment> $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DelegationRequest> $delegationRequests
 * @property-read int|null $delegation_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\Issue $issue
 * @property-read \App\Models\IssueProgressReport|null $issueProgressReport
 * @property-read \App\Models\Lawyer $lawyer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LawyerPoint> $points
 * @property-read int|null $points_count
 * @property-read \App\Models\SessionType $sessionType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereIsAttend($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereIssueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereOutcome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereSessionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sessionss whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSessionss {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $role_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Complaint> $complaints
 * @property-read int|null $complaints_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Consulation> $consulations
 * @property-read int|null $consulations_count
 * @property-read \App\Models\Employee|null $employee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Issue> $issues
 * @property-read int|null $issues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplication> $jobApplication
 * @property-read int|null $job_application_count
 * @property-read \App\Models\Lawyer|null $lawyer
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Profile|null $profile
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavedLegalBook> $savedLegalBook
 * @property-read int|null $saved_legal_book_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavedLegalNews> $savedLegalNews
 * @property-read int|null $saved_legal_news_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @property string|null $fcm_token
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LawyerPoint> $addedPoints
 * @property-read int|null $added_points_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueRequest> $caseRequests
 * @property-read int|null $case_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConsultationRequest> $consultationRequests
 * @property-read int|null $consultation_requests_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFcmToken($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

