<?php

namespace App\Models\Backend\ExamManagement;

use App\Models\Backend\QuestionManagement\QuestionStore;
use App\Models\Scopes\Searchable;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'exam_category_id',
        'title',
        'slug',
        'xm_type',
        'xm_date',
        'xm_date_timestamp',
        'xm_start_time',
        'xm_start_time_timestamp',
        'xm_end_time',
        'xm_end_time_timestamp',
        'xm_duration',
        'xm_pass_mark',
        'total_mark',
        'image',
        'is_paid',
        'is_featured',
        'status',
        'price',
        'xm_subscription_duration',
        'per_question_mark',
        'negative_mark',
        'mark_base_result',
        'subject_name',
    ];

    protected $searchableFields = ['*'];

    private static $exam;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::deleting(function ($exam){
            $exam->questionStores()->detach();
        });
    }

    public static function createOrUpdateExam ($request, $id = null)
    {
        self::$exam = Exam::updateOrCreate(['id' => $id], [
            'exam_category_id'                      => $request->exam_category_id,
            'title'                                 => $request->title,
            'slug'                                  => str_replace(' ', '-', $request->title),
            'xm_type'                               => $request->xm_type,
            'xm_date'                               => $request->xm_date,
            'xm_date_timestamp'                     => strtotime($request->xm_date),
            'xm_start_time'                         => $request->xm_start_time,
            'xm_start_time_timestamp'               => strtotime($request->xm_start_time),
            'xm_end_time'                           => $request->xm_end_time,
            'xm_end_time_timestamp'                 => strtotime($request->xm_end_time),
            'xm_duration'                           => $request->xm_duration,
            'total_mark'                            => $request->total_mark,
            'image'                                 => imageUpload($request->file('image'), 'exam-images/', 'xm-', '500', '500', isset($id) ? static::find($id)->image : ''),
            'xm_pass_mark'                          => $request->xm_pass_mark,
            'price'                                 => $request->price,
            'xm_subscription_duration'              => $request->xm_subscription_duration,
            'per_question_mark'                     => $request->per_question_mark,
            'negative_mark'                         => $request->negative_mark,
            'subject_name'                          => $request->subject_name,
            'is_paid'                               => $request->is_paid == 'on' ? 1 : 0,
            'is_featured'                           => $request->is_featured == 'on' ? 1 : 0,
            'status'                                => $request->status == 'on' ? 1 : 0,
            'mark_base_result'                      => $request->mark_base_result == 'on' ? 1 : 0,
        ]);
        self::$exam->questionStores()->sync($request->questions);
        if (self::$exam->is_paid == 0)
        {
            ExamCategory::find(self::$exam->exam_category_id)->update(['has_free_xm' => 1]);
        }
    }

    public function examCategory()
    {
        return $this->belongsTo(ExamCategory::class);
    }

    public function questionStores()
    {
        return $this->belongsToMany(QuestionStore::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
