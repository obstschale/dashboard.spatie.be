@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="4" rows="4">
    <todoist team-member="almut" position="a1:a2"></todoist>
    <todoist team-member="hans-helge" position="a3:a4"></todoist>
    <calendar position="d2:d4"></calendar>
    <time-weather position="b2:c2" time-format="HH:mm:ss" date-format="ddd DD. MMMM" time-zone="Europe/Berlin" weather-city="Augsburg" api-key="{{ $openWeatherMapApiKey }}"></time-weather>
    <tasks team-member="Fahrplan" position="d1"></tasks>
    <music position="b1:c1"></music>
    <uptime position="c3"></uptime>
    <losung position="b3:c4"></losung>
    <internet-connection></internet-connection>
</dashboard>

@endsection
