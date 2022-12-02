<?
include "functions.php";
?>
<div class="page">
  <h3> الاشتراك </h3>
  <br />
      <form class="form" method="post" action="" enctype="multipart/form-data" >
      <input class="form-control" type="text" name="name" placeholder="الاسم" />
      <input class="form-control" type="text" name="town" placeholder="المدينة" />
      <input class="form-control" type="text" name="address" placeholder="العنوان"/>
      <input class="form-control" type="number" name="mobile" placeholder="رقم الجوال " />
      <input class="form-control" type="email" name="email" placeholder=" الايميل " />
      <input class="form-control" type="number" name="age" placeholder="السن " />
      <label> الجنس </label>
        <select name="sex">
      <option>ذكر</option>
      <option>انثى</option>
      </select>
      <input class="form-control" type="text" name="job" placeholder="الوظيفة " />
      <input class="form-control" type="text" name="study" placeholder=" مرحلة الدراسة " />
      <label>الفرع</label>
      <input class="about-btn" type="submit" name="submit" value="AddNew"/>
      </form>
      <?
      insert("students","");
      ?>
</div>

