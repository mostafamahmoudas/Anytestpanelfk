<?php
// إعدادات التاريخ
$currentMonth = date('m'); // الشهر الحالي
$currentYear = date('Y');  // السنة الحالية

// إذا تم تمرير شهر وسنة عبر GET، تحديث الشهر والسنة
if (isset($_GET['month']) && isset($_GET['year'])) {
    $currentMonth = $_GET['month'];
    $currentYear = $_GET['year'];
}

// الحصول على اليوم الأول في الشهر
$firstDayOfMonth = strtotime("$currentYear-$currentMonth-01");
$numberOfDaysInMonth = date('t', $firstDayOfMonth);  // عدد الأيام في الشهر
$dayOfWeek = date('w', $firstDayOfMonth); // اليوم في الأسبوع الذي يبدأ فيه الشهر (0 = الأحد)

// بناء التقويم
echo "<h2>التقويم: " . date('F Y', $firstDayOfMonth) . "</h2>";

echo "<table border='1' cellspacing='0' cellpadding='5'>";
echo "<tr>
        <th>الأحد</th>
        <th>الإثنين</th>
        <th>الثلاثاء</th>
        <th>الأربعاء</th>
        <th>الخميس</th>
        <th>الجمعة</th>
        <th>السبت</th>
      </tr>";

echo "<tr>";

// ترك الخلايا الفارغة قبل اليوم الأول في الشهر
for ($i = 0; $i < $dayOfWeek; $i++) {
    echo "<td></td>";
}

// إضافة الأيام الفعلية في الشهر
for ($day = 1; $day <= $numberOfDaysInMonth; $day++) {
    // إذا كان اليوم هو آخر يوم في الأسبوع (السبت)، إغلاق الصف وبدء صف جديد
    if (($day + $dayOfWeek - 1) % 7 == 0 && $day != 1) {
        echo "</tr><tr>";
    }
    
    // عرض اليوم
    echo "<td>$day</td>";
}

// إغلاق الصف الأخير إذا لم يكن مكتمل
while (($day + $dayOfWeek - 1) % 7 != 0) {
    echo "<td></td>";
    $day++;
}

echo "</tr>";
echo "</table>";

// أزرار التنقل بين الأشهر
$prevMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
$nextMonth = ($currentMonth == 12) ? 1 : $currentMonth + 1;
$prevYear = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
$nextYear = ($currentMonth == 12) ? $currentYear + 1 : $currentYear;

echo "<div style='margin-top: 20px;'>";
echo "<a href='?month=$prevMonth&year=$prevYear'>&lt; الشهر السابق</a> | ";
echo "<a href='?month=$nextMonth&year=$nextYear'>الشهر التالي &gt;</a>";
echo "</div>";
?>
