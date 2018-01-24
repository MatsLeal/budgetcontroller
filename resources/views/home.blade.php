@extends('layouts.app')

@section('content')
   <div id="root" class="container">
    
        <tabs>

            <tab name=" Dashboard" :selected="true">
                <months>
                        <month name="January"  ></month>
                        <month name="Feburary" ></month>
                        <month name="March" ></month>
                        <month name="April" ></month>
                </months>

                <months>
                        <month name="May"  ></month>
                        <month name="June" ></month>
                        <month name="July" ></month>
                        <month name="Agust" ></month>
                </months>

                <months>
                        <month name="Sempteber" ></month>
                        <month name="October"  ></month>
                        <month name="November" ></month>
                        <month name="December" ></month>
                </months>
            </tab>

            <tab name=" Report">
                <h1> Culture</h1>
            </tab>

            <tab name=" yala yala">
                <h1>  Vision </h1>
            </tab>
        </tabs>
    </div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
