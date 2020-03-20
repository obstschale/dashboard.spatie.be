@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer', 'openWeatherMapApiKey'))

<dashboard id="dashboard" columns="4" rows="4">
    <todoist team-member="almut" position="a1:a2"></todoist>
    <todoist team-member="hans-helge" position="a3:a4"></todoist>
    <calendar position="d2:d3"></calendar>
    <speedtest position="d4"></speedtest>
    <time-weather position="b2:c2" time-format="HH:mm:ss" date-format="ddd DD. MMMM" time-zone="Europe/Berlin" weather-city="Augsburg"></time-weather>
    <tasks team-member="Fahrplan" position="d1"></tasks>
    <corona position="b1"></corona>
    <music position="c1"></music>
    <uptime position="c3"></uptime>
    <losung position="b3:c4"></losung>
    <internet-connection></internet-connection>
</dashboard>

@endsection
