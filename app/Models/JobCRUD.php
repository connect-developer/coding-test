<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

// Calling other dependencies
use App\Enums\JobStatus;

// Calling required models
use Job;

class JobCRUD extends Model
{
    use HasFactory;

    public static function store($object, $id = null)
    {
        DB::beginTransaction();
        try{
            if($id == null) { // -> It mean for inserting to Job
                $job = new Job;
            }else{ // And this is for update job
                $job = Job::find($id);
                if(empty($job)){
                    return response()->json([
                        "status" => 404,
                        "message" => "Job isn't found."
                    ]);
                }
            }
            $job->company_id = $object->company_id;
            $job->job_title_id = $object->job_title_id;
            $job->description = $object->description;
            $job->status = JobStatus::fromKey($object->status);
            $job->save();
            DB::commit();
            return $job;
        }catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => 401,
                "message" => $e->getMessage()
            ]);
        }
    }

    public static function delete(int $id)
    {
        DB::beginTransaction();
        try{
            $job = Job::find($id);
            if($job){
                $job->delete();
            }
            DB::commit();

            return true;
        } catch(Exception $e){
            DB::rollback();
            return response()->json([
                "status" => 401,
                "message" => $e->getMessage()
            ]);
        }
    }
}
