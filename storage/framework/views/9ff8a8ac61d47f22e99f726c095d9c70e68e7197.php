<div>

    <?php if($getState() =="Active"): ?>
    <span
        style="background-color:rgba(0,208,255,0.18);color: #00ff51;border-radius: 50px; font-weight: bold;  padding: 5px 10px">قيد الاصلاح</span>
    <?php elseif($getState() =="Invalid"): ?>
    <span style="background-color:rgba(253,1,1,0.1);color: #80000f;border-radius: 50px ;font-weight: bold;  padding: 5px 10px">منسق</span>
    <?php elseif($getState() =="Waiting"): ?>
    <span
        style="background-color:rgba(126,124,31,0.1);color: #ffde00;border-radius: 50px ;font-weight: bold;  padding: 5px 10px">في الانتظار</span>
    <?php else: ?>
    <span
        style="background-color:rgba(1,253,1,0.1);color: green;border-radius: 50px ;font-weight: bold;  padding: 5px 10px">تم الاصلاح</span>
    <?php endif; ?>
</div>

<?php /**PATH F:\xampp\htdocs\shfaa\resources\views/tables/columns/status-fix-sheet.blade.php ENDPATH**/ ?>