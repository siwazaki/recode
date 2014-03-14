<?php

class ApiController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getCommits() {
    //ToDo
    $userId = 1;
    $dateFromStr = Input::get('dateFrom');
    $dateToStr = Input::get('dateTo');
    $dateFrom = new DateTime($dateFromStr);
    $dateTo = new DateTime($dateToStr);
    $query = \Commit::CommitsSummaryBetween($userId, $dateFrom, $dateTo);
    $commits = $query->get();

    $xkey = "date";
    $ykeys = array_merge(array_unique(array_pluck($commits, 'repository_name')));

    $d = new \DateTime($dateFromStr);

    $dateToCommit = array();
    while ($d <= $dateTo) {
      $date = $d->format('Y-m-d');
      $one = array('date' => $date);
      foreach ($ykeys as $ykey) {
        $one[$ykey] = 0;
      }
      $dateToCommit[$date] = $one;
      $d->add(new DateInterval('P1D'));
    }

    foreach ($commits as $commit) {
      $dateToCommit[$commit->date][$commit->repository_name] = $commit->nb_commits;
    }

    $xs = array();
    foreach ($dateToCommit as $date => $commits) {
      $one = array('date' => $date);
      foreach ($commits as $repository_name => $nbCommits) {
        $one[$repository_name] = $nbCommits;
      }
      $xs[] = $one;
    }

    return Response::json(
                    array(
                        'xkey' => $xkey,
                        'ykeys' => $ykeys,
                        'labels' => $ykeys,
                        'xs' => $xs
                    )
    );
  }

  public function getStats() {
    $userId = 1;
    $dateFromStr = Input::get('dateFrom');
    $dateToStr = Input::get('dateTo');
    $dateFrom = new DateTime($dateFromStr);
    $dateTo = new DateTime($dateToStr);
    $stats = \Stats::getStats($userId, $dateFrom, $dateTo);
    return Response::json($stats);
  }


  public function postCommits() {
    $userId = Input::get('user_id');
    $authKey = Input::get('recode_auth_key');
    $repositoryId = Input::get('repository_id');
    $repository = \Repository::findOrFail($repositoryId);
    if(!is_null($repository))
    {
      \Commit::create(array('user_id'=> $userId, 'repository_id' => $repositoryId));
    }

  }

}
