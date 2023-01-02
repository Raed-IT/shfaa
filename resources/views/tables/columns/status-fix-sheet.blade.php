<div>

    @if($getState() =="Active")
    <span
        style="background-color:rgba(0,208,255,0.18);color: #00ff51;border-radius: 50px; font-weight: bold;  padding: 5px 10px">قيد الاصلاح</span>
    @elseif($getState() =="Invalid")
    <span style="background-color:rgba(253,1,1,0.1);color: #80000f;border-radius: 50px ;font-weight: bold;  padding: 5px 10px">منسق</span>
    @elseif($getState() =="Waiting")
    <span
        style="background-color:rgba(126,124,31,0.1);color: #ffde00;border-radius: 50px ;font-weight: bold;  padding: 5px 10px">في الانتظار</span>
    @else($getState() =="Don")
    <span
        style="background-color:rgba(1,253,1,0.1);color: green;border-radius: 50px ;font-weight: bold;  padding: 5px 10px">تم الاصلاح</span>
    @endif
</div>

