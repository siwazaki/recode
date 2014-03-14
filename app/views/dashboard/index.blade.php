@extends('layouts.master')
@section('content')

<div id="date-slider" class="ui-sliderDemo"></div>

<div class="row">
  <div class="col-lg-12">

    <!-- commit area panel -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Your Commits
        <div class="pull-right">
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
              Actions
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href="#">Action</a>
              </li>
              <li><a href="#">Another action</a>
              </li>
              <li><a href="#">Something else here</a>
              </li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel-body" id="commit-chart-wrapper">
        <div id="commit-chart"></div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-table fa-fw"></i> Statistics

      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Ave. per day</th>
                <th>Var. per day</th>
                <th>Max. per day</th>
                <th>Sum</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="s_val_ave"></td>
                <td id="s_val_var"></td>
                <td id="s_val_max"></td>
                <td id="s_val_sum"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- statistics table panel-->
    @stop