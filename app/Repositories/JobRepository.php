<?php

namespace App\Repositories;

use App\Core\Request\ListDataRequest;
use App\Core\Request\ListSearchDataRequest;
use App\Core\Request\ListSearchPageDataRequest;
use App\Models\Job;
use App\Repositories\Contracts\IJobRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class JobRepository extends BaseRepository implements IJobRepository
{
    public Job $_job;

    public function __construct(Job $job)
    {
        parent::__construct($job);
        $this->_job = $job;
    }

    public function allJob(ListDataRequest $request): Collection
    {
        $model = $this->model->select('jobs.*',
            'job_titles.name AS job_title_name',
            'companies.name AS company_name')
            ->join('job_titles', 'job_titles.id', '=', 'jobs.job_title_id')
            ->join('companies', 'companies.id', '=', 'jobs.company_id');

        if (count($request->filter) > 0) {
            $filter = [];

            foreach ($request->filter as $value) {
                if ($value[0] === 'status') {
                    $filter[] = $value;
                }

                if ($value[0] === 'company_id') {
                    $filter[] = $value;
                }

                if ($value[0] === 'job_title_id') {
                    $filter[] = $value;
                }
            }

            $model = $model->where($filter);
        }

        return $model->orderBy($request->order_by, $request->sort)
            ->get();
    }

    public function allSearchJob(ListSearchDataRequest $request): Collection
    {
        $model = $this->model->select('jobs.*',
            'job_titles.name',
            'companies.name')
            ->join('job_titles', 'job_titles.id', '=', 'jobs.job_title_id')
            ->join('companies', 'companies.id', '=', 'jobs.company_id');

        if ($request->search) {
            $keyword = $request->search;

            $model = $model->whereRaw("(description LIKE ? OR
                job_titles.name LIKE ? OR
                companies.name LIKE ?)", $this->searchJobByKeyword($keyword));
        }

        if (count($request->filter) > 0) {
            $filter = [];

            foreach ($request->filter as $value) {
                if ($value[0] === 'status') {
                    $filter[] = $value;
                }

                if ($value[0] === 'company_id') {
                    $filter[] = $value;
                }

                if ($value[0] === 'job_title_id') {
                    $filter[] = $value;
                }
            }

            $model = $model->where($filter);
        }

        return $model->orderBy($request->order_by, $request->sort)
            ->get();
    }

    public function allSearchPageJob(ListSearchPageDataRequest $request): Paginator
    {
        $model = $this->model->select('jobs.*',
            'job_titles.name',
            'companies.name')
            ->join('job_titles', 'job_titles.id', '=', 'jobs.job_title_id')
            ->join('companies', 'companies.id', '=', 'jobs.company_id');

        if ($request->search) {
            $keyword = $request->search;

            $model = $model->whereRaw("(description LIKE ? OR
                job_titles.name LIKE ? OR
                companies.name LIKE ?)", $this->searchJobByKeyword($keyword));
        }

        if (count($request->filter) > 0) {
            $filter = [];

            foreach ($request->filter as $value) {
                if ($value[0] === 'status') {
                    $filter[] = $value;
                }

                if ($value[0] === 'company_id') {
                    $filter[] = $value;
                }

                if ($value[0] === 'job_title_id') {
                    $filter[] = $value;
                }
            }

            $model = $model->where($filter);
        }

        return $model->orderBy($request->order_by, $request->sort)
            ->simplePaginate($request->per_page, $request->page);
    }

    private function searchJobByKeyword(string $keyword) {
        return [
            'description' => "%" . $keyword . "%",
            'job_titles.name' => "%" . $keyword . "%",
            'company.name' => "%" . $keyword . "%"
        ];
    }
}
