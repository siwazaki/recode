<?php

class Commit extends Eloquent {

  protected $guarded = array();
  public static $rules = array();
  protected $table = 'commits';

  public function user() {
    return $this->belongsTo('User');
  }

  public function repository() {
    return $this->belongsTo('Repository');
  }

  public function scopeCommitsAllSummaryBetween($query, $userId, \DateTime $dateFrom, \DateTime $dateTo, $sumType = 'D') {
    \DbC::RP($sumType === "D", 666, '$sumType should be "D"');
    $query = $this->scopeCommitsAllBetween($query, $userId, $dateFrom, $dateTo);
    $query->groupBy(DB::raw('DATE(commits.created_at)'));
    $query->select(array(
        DB::raw('DATE(commits.created_at) AS date'),
        DB::raw('count(*) AS nb_commits')
    ));

    return $query;
  }

  public function scopeCommitsSummaryBetween($query, $userId, \DateTime $dateFrom, \DateTime $dateTo, $sumType = 'D') {
    $query = $this->scopeCommitsBetween($query, $userId, $dateFrom, $dateTo);
    switch ($sumType) {
      case 'H':

        break;
      case 'D':
        $query->groupBy('repositories.id');
        $query->groupBy(DB::raw('DATE(commits.created_at)'));
        $query->orderBy('repositories.id');
        $query->orderBy(DB::raw('DATE(commits.created_at)'));
        $query->select(array(
            DB::raw('DATE(commits.created_at) AS date'),
            DB::raw('YEAR(commits.created_at) AS year'),
            DB::raw('MONTH(commits.created_at) AS month'),
            DB::raw('DAY(commits.created_at) AS day'),
            DB::raw('repositories.id AS repository_id'),
            DB::raw('repositories.name AS repository_name'),
            DB::raw('count(*) AS nb_commits')
        ));
        break;
      case 'W':

        break;

      case 'M':

        break;

      case 'Y':
        break;

      default:
        break;
    }
    return $query;
  }

  public function scopeCommitsBetween($query, $userId, \DateTime $dateFrom, \DateTime $dateTo) { {
      $dateFromStr = $dateFrom->format('Y-m-d 00:00:00');
      $dateToStr = $dateTo->format('Y-m-d 23:59:59');
      $query->join('repositories', 'commits.repository_id', '=', 'repositories.id');
      $query->where('commits.user_id', '=', $userId);
      $query->whereBetween('commits.created_at', array($dateFromStr, $dateToStr));
      return $query;
    }
  }

  public function scopeCommitsAllBetween($query, $userId, \DateTime $dateFrom, \DateTime $dateTo) {
    $dateFromStr = $dateFrom->format('Y-m-d 00:00:00');
    $dateToStr = $dateTo->format('Y-m-d 23:59:59');
    $query->where('commits.user_id', '=', $userId);
    $query->whereBetween('commits.created_at', array($dateFromStr, $dateToStr));
    return $query;
  }

}
