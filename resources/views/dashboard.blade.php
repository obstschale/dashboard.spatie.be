@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="4" rows="4">
    <tasks team-member="almut" position="a1:a2"></tasks>
    <todoist team-member="hans-helge" position="a3:a4"></todoist>
    <calendar position="d2:d3"></calendar>
    <time-weather position="b1" time-format="HH:mm:ss" date-format="ddd DD. MMMM" time-zone="Europe/Berlin" weather-city="Augsburg"></time-weather>
    <tasks team-member="Fahrplan" position="d1"></tasks>
    <music position="b2:c2"></music>
    <uptime position="c3"></uptime>
    <internet-connection></internet-connection>
</dashboard>

@endsection
