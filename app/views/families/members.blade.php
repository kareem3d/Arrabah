@extends('master.layout1')

@section('body')
<div class="white-box families" style="padding-bottom:20px;">
    <h2 class="title title-font">
        <div class="family-icon"></div>
        {{ $membersTitle }}
    </h2>

    <div class="tools">

        <select class="select2 age-slct" style="width:140px;">
            <option value=""></option>
            <option value="all-ages">كل الأعمار</option>
            <option value="above-18">أكبر من 18 سنة</option>
            <option value="below-18">أصغر من 18 سنة</option>
        </select>

    </div>

    <div class="all">

        @foreach($familyUsers as $user)
        <div class="boxgrid caption">
            <div class="user-stars">
                @if($user->fromArrabah())
                <div class="green-star user-star" tip="هذا العضو من أبناء البلد"></div>
                @endif
                @if($user->isPremium())
                <div class="red-star user-star" tip="هذا العضو مشترك فى رابطة عرابة"></div>
                @endif
            </div>
            <a href="{{ URL::profile($user) }}">
                @if($user->profileImage)
                <img src="{{ $user->profileImage->getUrl( 145, 145 ) }}" width="145" height="145"/>
                @else
                <img src="{{ AlbumsManager::defaultImage('user.profile') }}" width="145" height="145"/>
                @endif
            </a>

            <div class="cover boxcaption">
                <p>{{ $user->first_name }} - {{ $user->father_name }}<br/></p>
            </div>
        </div>
        @endforeach

        <div class="clr"></div>

    </div>
</div><!-- END of white-box -->


<div class="pages">
    <ul>
        {{ $familyUsers->links() }}

        <!-- <li><a href="#" class="active">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li> -->
    </ul>
</div>
@stop

@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {
        $(".select2").select2({placeholder: 'أختار العمر'});

        $(".age-slct").select2('val', "{{ Input::get('age') }}");

        $(".age-slct").change(function () {

            insertParam('age', $(this).val());
//		var url = [location.protocol, '//', location.host, location.pathname].join('');
//		url = url + "?age=" + $(this).val();
//
//		@if(Input::get('keyword'))
//		url = url + "&keyword={{ Input::get('keyword') }}";
//		@endif
//
//		window.location.href = url;
        });
    });


    function insertParam(key, value) {
        key = encodeURI(key);
        value = encodeURI(value);

        var kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--) {
            x = kvp[i].split('=');

            if (x[0] == key) {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key, value].join('=');
        }

        //this will reload the page, it's likely better to store this until finished
        document.location.search = kvp.join('&');
    }

</script>

@stop