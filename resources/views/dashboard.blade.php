@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="3" rows="3">
    {{--<calendar position="a1"></calendar>--}}
    <todoist team-member="hans-helge" position="a1"></todoist>
    <time-weather position="b1" time-format="HH:mm:ss" date-format="ddd DD. MMMM" time-zone="Europe/Berlin" weather-city="Augsburg"></time-weather>
    <tasks team-member="Fahrplan" position="c1"></tasks>
    <music position="a2:c2"></music>
    <tasks team-member="hans-helge" position="a3"></tasks>
    <tasks team-member="almut" position="b3"></tasks>
    <uptime position="c3"></uptime>
    <internet-connection></internet-connection>
</dashboard>

@endsection
