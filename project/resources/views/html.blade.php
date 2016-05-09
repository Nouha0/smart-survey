@extends('Default')

@section('title','remplir le formulaire')

@section('content')
    {!! Form::open(['method'=>'POST']) !!}
    <div id="box">
        {!! Form::hidden('json',$html,['class'=>'json']) !!}
        
    


    </div>
    <br />
    <button type="submit" class="btn btn-success">envoyé</button>
    {!! Form::close() !!}
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.2.1/mustache.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.8.1/mustache.min.js"></script>
    <script type="x-tmpl-mustache" id="helloTmpl">
          
            @{{#fields}}
                <br />
                <label>@{{label}}</label> <br />
                @{{#field_options}}
                    @{{#options}}
                        <input type="@{{field_type}}" size="@{{size}}" minlength="@{{minlength}}" maxlength="@{{maxlength}}" required="@{{required}}" name="@{{name}}" >
                                @{{label}}
                        </input> <br />
                    @{{/options}}
                    @{{^options}}
                        <input type="@{{field_type}}" size="@{{size}}" minlength="@{{minlength}}" maxlength="@{{maxlength}}" required="@{{required}}" name="@{{fields.label}}" >
                        </input> <br />
                    @{{/options}}
                @{{/field_options}}
                @{{^field_options}}
                    <input type="@{{field_type}}" required="@{{required}}" name="@{{name}}">
                @{{/field_options}}
            @{{/fields}}
           <input type="radio" name="gender" value="male"> Male<br>
           <input type="radio" name="gender" value="female"> Female<br>
           <input type="radio" name="gender" value="other"> Other
    </script>
    <script>
        var jdataText = $(".json").val();
        //var jdata = JSON.parse(jdataText);
        console.log(jdataText);
        
        var data ={"fields":[{"label":"sexe","field_type":"checkbox","required":true,"field_options":{"options":[{"label":"Homme","checked":false,"name":"n"},{"label":"Femme","checked":false,"name":"n"}]},"cid":"c2"},{"label":"formation","field_type":"radio","required":true,"field_options":{"options":[{"label":"continue","checked":false,"name":"f"},{"label":"Apprentissage","checked":false,"name":"f"}],"include_other_option":true},"cid":"c6"},{"label":"nom","field_type":"text","required":true,"field_options":{"size":"medium","minlength":"3","maxlength":"17","min_max_length_units":"characters"},"cid":"c11"}]}
    
        var tmpl = $("#helloTmpl").html();
        var html = Mustache.to_html(tmpl,data);
        //console.log(tmpl);
        //console.log(html);
       // console.log(data.title);
        var box = $("#box").html(html);
        //box.innerHTML = html ; 
        //$("#box").html(html);
        //console.log(html);
    </script>
@endsection

