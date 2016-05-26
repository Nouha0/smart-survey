@extends('Default')

@section('title','remplir le formulaire')

@section('content')
    {!! Form::open(['method'=>'POST','url'=>route('add-reponse',[$enqueteur->id,$projet->id])]) !!}
        
            <div id="box">
                
            </div>
            <br />
            <button type="submit" class="btn btn-success">envoyé</button>
       
    {!! Form::close() !!}
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.2.1/mustache.min.js"></script>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.8.1/mustache.min.js"></script>
    
    
    <script id="input" type="x-tmpl-mustache">
      
      <label for="@{{cid}}">@{{label}}</label>
        <input type="@{{field_type}}" class="form-control" id="@{{cid}}" name="@{{field_options.description}}" placeholder="" required="@{{required}}">
      <br />
      
    </script>

    <script id="textarea" type="x-tmpl-mustache">

    <label>@{{label}}</label>
    <textarea class="form-control" name="@{{field_options.description}}"rows="3" required="@{{required}}"></textarea>
    <br />
    </script>

    <script id="select" type="x-tmpl-mustache">
      <label>@{{label}}</label>
      <select class="form-control" name="@{{field_options.description}}">
        @{{#field_options.options}}

          <option value="@{{label}}" checked="@{{checked}}"> @{{label}}</option>

        @{{/field_options.options}}
      </select>
      <br/>
    </script>

    <script id="checkbox" type="x-tmpl-mustache">
      
      <label>@{{label}}</label><br/>
        @{{#field_options.options}}
          
            <input type="checkbox" name="@{{field_options.description}}[]" value="@{{label}}" > @{{label}}
            <br/>
        @{{/field_options.options}}
        <br/>

    </script>
    <script id="radio" type="x-tmpl-mustache">
     
      <label>@{{label}}</label><br />
        @{{#field_options.options}}
          
            <input  type="radio" name="@{{field_options.description}}" @{{required}} value="@{{label}}"> @{{label}}
             <br/>
        @{{/field_options.options}}
        <br/>
      

    </script>
    <script>
      $(document).ready(function(){
           var jdataText = '{!! $projet->projet_html !!}'; 
        
        console.log(jdataText);
    
       function loadUser() {
            var input     = $('#input').html();
            var checkbox  = $('#checkbox').html();
            var textarea  = $('#textarea').html();
            var select    = $('#select').html();
            var radio    = $('#radio').html();
            var inputText = ["text", "number", "site", "email", "website"];
            var el = jQuery.parseJSON(jdataText).fields;
              console.log(el);
            for (var i = 0; i < el.length; i++) {
              var type = el[i].field_type;
              console.log(type);

             // console.log(el[i]);
              if(type == "radio"){
                template = radio;
              }
              else if(type == "checkboxes"){
                template = checkbox;
              }
              else if(type == "textarea"){
                template = textarea;
              }
              else if(type =="select"){
                template = select;
              }
              else if(type == "text" || type== "number" || type == "website" || type== "file"){
                template = input;
              }

              
              Mustache.parse(template);
              var rendered = Mustache.render(template, el[i]);
              $('#box').append(rendered);
            }

        }
        loadUser();
      });  
       
    </script>
@endsection

