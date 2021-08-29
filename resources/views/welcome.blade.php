<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

        

        <style>
            @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
            body{
                padding:5%;
            }
            select{
                font-family: 'FontAwesome' , 'TATSanaChon';
            }
            body {
                font-family: 'Nunito', sans-serif;
              font-weight: 300;
            }
            .tabs {
              max-width: 100%;
              margin: 0 auto;
              padding: 0 20px;
            }
            #tab-button {
              display: table;
              table-layout: fixed;
              width: 100%;
              margin: 0;
              padding: 0;
              list-style: none;
            }
            #tab-button li {
              display: table-cell;
              width: 20%;
            }
            #tab-button li a {
              display: block;
              padding: .5em;
              background: #eee;
              border: 1px solid #ddd;
              text-align: center;
              color: #000;
              text-decoration: none;
            }
            #tab-button li:not(:first-child) a {
              border-left: none;
            }
            #tab-button li a:hover,
            #tab-button .is-active a {
              border-bottom-color: transparent;
              background: #fff;
            }
            .tab-contents {
              padding: .5em 2em 1em;
              border: 1px solid #ddd;
            }



            .tab-button-outer {
              display: none;
            }
            .tab-contents {
              margin-top: 20px;
            }
            @media screen and (min-width: 768px) {
              .tab-button-outer {
                position: relative;
                z-index: 2;
                display: block;
              }
              .tab-select-outer {
                display: none;
              }
              .tab-contents {
                position: relative;
                top: -1px;
                margin-top: 0;
              }
            }
            .list{ 
                width:  250px;
                margin-left: 25px;
             }
            #div_categorieList{
                display: flex;
            }
        </style>
    </head>
    <body class="antialiased">
        <br/>
        <div class="text-center">
            <a href="{{ url('lang/ar') }}" class="@if($lang == 'ar') font-weight-bold @endif">عربي</a>
            <a href="{{ url('lang/en') }}" class="@if($lang == 'en') font-weight-bold @endif">english</a>
        </div>
        <br/>
        <div class="tabs">
          <div class="tab-button-outer">
            <ul id="tab-button">
              <li><a href="#tab01">@lang('home.Browse Categories')</a></li>
              <li><a href="#tab02">@lang('home.Most Used Categories')</a></li>
            </ul>
          </div>

          <div id="tab01" class="tab-contents">
            <h2>@lang('home.Browse Categories')</h2>
            <div class="row">
                <select class="form-control col-3" id="categorieList" onchange="LoadSubCategorie(this)" select-index="0">
                    <option value="" selected disabled>@lang('home.Choose')</option>
                  @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" type="categorie">{{ $categorie->name }} > </option>
                  @endforeach
                </select>
            </div>
            <br>
            <center><h3><b id="SelectedProduct"></b></h3></center>
            <center><button class="btn btn-success">@lang('home.Choose')</button></center>
          </div>
          <div id="tab02" class="tab-contents">
            <h2>@lang('home.Most Used Categories')</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
          </div>
        </div>
        <script type="text/javascript">
            function LoadSubCategorie(element){
                var this_element = $(element);
                var selected_type = this_element.find(":selected").attr('type');
                if(selected_type == 'produit'){
                    $('#SelectedProduct').html(this_element.find(":selected").text());
                }else{
                    var id_select = this_element.attr('id');
                    var next_index = Number(this_element.attr('select-index')) + 1;

                    $('#SelectedProduct').html('');
                    $('#div_' + id_select).remove();

                    var div = $("<div></div>").attr("id", 'div_' + id_select);
                    var select = $("<select></select>").attr("id", "select_"+next_index).attr("class", "form-control list").attr("select-index", next_index).attr("onchange", "LoadSubCategorie(this)");

                    select.append($("<option></option>").attr("value", "").attr("selected", "selected").attr("disabled","disabled").text("@lang('home.Choose')"));
                    $.get("{{ url('loadSubCategorie') }}/?categorie_id="+element.value, function(data, status){

                         $.each(data.result.sub_categories,function(index,item){
                          select.append($("<option></option>").attr("value", item.id).attr("type", "categorie").text(item.name + ' >'));
                         });

                         $.each(data.result.products,function(index,item){
                          select.append($("<option></option>").attr("value", item.id).attr("type", "produit").text(item.name));
                         });
                    });
                    this_element.parent().append(div.append(select));
                }
            }
            $(function() {
              var $tabButtonItem = $('#tab-button li'),
                  $tabSelect = $('#tab-select'),
                  $tabContents = $('.tab-contents'),
                  activeClass = 'is-active';

              $tabButtonItem.first().addClass(activeClass);
              $tabContents.not(':first').hide();

              $tabButtonItem.find('a').on('click', function(e) {
                var target = $(this).attr('href');

                $tabButtonItem.removeClass(activeClass);
                $(this).parent().addClass(activeClass);
                $tabSelect.val(target);
                $tabContents.hide();
                $(target).show();
                e.preventDefault();
              });

              $tabSelect.on('change', function() {
                var target = $(this).val(),
                    targetSelectNum = $(this).prop('selectedIndex');

                $tabButtonItem.removeClass(activeClass);
                $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                $tabContents.hide();
                $(target).show();
              });
            });
        </script>
    </body>
</html>
