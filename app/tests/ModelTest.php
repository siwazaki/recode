<?php

class ModelTest extends TestCase {

  public function testUserCanFind() {
    $res = \User::with("repositories")->find(1);
    $this->assertTrue($res->count() > 0);
    $this->assertTrue($res->repositories->count() > 0);
  }

  public function testRepositoryCanFind() {
    $res = \Repository::with(array("user", "commits"))->find(2);
    $this->assertTrue($res->count() > 0);
    $this->assertTrue($res->commits->count() > 0);
    $this->assertNotNull($res->user);
    $this->assertNotNull($res->user->id);
  }

  public function testCommitCanFind() {
    $res = \Commit::with(array("user", "repository"))->take(1)->first();
    $this->assertTrue($res->count() > 0);
    $this->assertTrue($res->repository->count() > 0);
    $this->assertTrue($res->user->count() > 0);
  }

  public function testGetCommitsBetween() {
    $query = \Commit::CommitsBetween(1, new DateTime('2014-01-29'), new DateTime('2014-01-30'));
    $query->with('repository');
    $res = $query->get();
  }

  public function testGetCommitsAllBetween() {
    $query = \Commit::CommitsAllBetween(1, new DateTime('2014-01-29'), new DateTime('2014-01-30'));
    $query->with('repository');
    $res = $query->get();
  }

  public function testGetCommitsSummaryBetween() {
    $query = \Commit::CommitsSummaryBetween(1, new DateTime('2014-01-29'), new DateTime('2014-01-30'));
    $res = $query->get();
  }

  public function testGetCommitsAllSummaryBetween() {
    $query = \Commit::CommitsAllSummaryBetween(1, new DateTime('2014-01-29'), new DateTime('2014-01-30'));
    $res = $query->get();
  }


  public function testDiff() {
    $d1 = new \DateTime('2014-01-01');
    $d2 = new \DateTime('2014-01-10');
    $diff = $d1->diff($d2);
  }

}