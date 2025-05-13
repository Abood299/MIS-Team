<!DOCTYPE html>
<html lang="en" >
<meta charset="UTF-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- put on all pages  -->
     
    <base href="/businesshub/">
    <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">
    <link rel="stylesheet" href="css/deps.css"> <!-- to grab deps css -->

    <title>Academic Staff Emails & Office Location</title>
    <style>
        
    
/* === Page & Table Base Styles === */
body {
  background-color: #FAF9F6;
}

.table img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.table th,
.table td {
  vertical-align: middle;
  text-align: center;
}

/* Soft drop‑shadow and rounded corners on table */
.table {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  border-radius: 0.25rem;
}

/* Header theme color */
.table thead th {
  background-color: #5E2950 !important;
  color:          #FAF9F6 !important;
  border-color:   #5E2950 !important;
}

/* === Uniform Row Background === */
/* Applies to every <tr> in <tbody>—no more light/dark alternation */
.table tbody tr > th,
.table tbody tr > td {
  background-color: #e0e0e0 !important;
}
/* Override Bootstrap’s stripe backgrounds */
.table-striped > tbody > tr:nth-of-type(odd) > *,
.table-striped > tbody > tr:nth-of-type(even) > * {
  background-color: #e0e0e0 !important;
}

/* Highlight only the last two columns’ text in your brand color */
.table tbody tr > td:nth-last-child(-n+2) {
  color: #EC522D !important;
}

/* === Link & Button Tweaks === */
/* Remove underline & set Bootstrap‑blue on name/email links */
.container table tbody tr td:nth-child(2) a,
.container table tbody tr td:nth-child(3) a {
  text-decoration: none !important;
  color:           #0d6efd;
}
.container table tbody tr td:nth-child(2) a:hover,
.container table tbody tr td:nth-child(3) a:hover {
  text-decoration: underline;
}

/* Major‑filter buttons layout and hover state */
.btn-group {
  display:         flex;
  flex-wrap:       wrap;
  justify-content: center;
}
.btn-group .btn {
  margin: 5px;
}
.btn-group .btn:hover,
.btn-group .btn:focus {
  background-color: #343a40;
}

/* Utility: hide rows via .hidden */
.hidden {
  display: none !important;
}
/* === Profile‑Pic Modal === */
#imgModal {
  display: none;            /* keep it hidden */
  position: fixed;
  top: 0; left: 0;
  width: 100%;
  height: 100vh;            /* full viewport height */
  background: rgba(0,0,0,0.8);
  z-index: 1050;
  
  /* prepare for flex when we add .show */
  justify-content: center;
  align-items: center;
}

/* When we add this class via JS, it becomes a centered flexbox */
#imgModal.show {
  display: flex;
}

/* The content itself can be positioned relative so the close‑button
   can sit in the corner if you like */
#imgModal .modal-content {
  position: relative;
}
#imgModal img {
  width: 300px;
  height: 300px;
  object-fit: cover;
  border-radius: 50%;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}
#imgModal .close-btn {
  position: absolute;
  top: -120px;
  right: 300px;
  background: #fff;
  border: none;
  font-size: 1.5rem;
  line-height: 1;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  cursor: pointer;
}
   
    </style>
</head>

<body>

<?php include 'includes/header.php'; ?>

     <!-- Search & Filter Row -->
  <div class="container my-3">
    <div class="row justify-content-center align-items-center">
      <!-- Search Bar -->
      <div class="col-md-6 mb-2">
      <div class="input-group">
        <input
          id="tableSearch"
          type="text"
          class="form-control border-end-0"
          placeholder="ابحث في أسماء الأساتذة، البريد أو التخصص…">
        <span class="input-group-text bg-white border-start-0">
          <i class="fas fa-search text-secondary"></i>
        </span>
      </div>
    </div>
      <!-- Dropdown Filter -->
      <div class="col-md-3 mb-2">
        <select id="majorFilter" class="form-select">
          <option value="all">اختر التخصص</option>
          <option value="mis">نظم المعلومات الإدارية</option>
          <option value="business">إدارة الأعمال</option>
          <option value="marketing">التسويق</option>
          <option value="accounting">المحاسبة</option>
          <option value="finance">التمويل</option>
          <option value="economics">الاقتصاد</option>
          <option value="public_managment">الإدارة العامة</option>
        </select>
      </div>
    </div>
  </div>

 <!-- Table -->
 <div class="container">
    <table class="table table-bordered bg-white">
      <thead class="table-dark">
        <tr>
          <th>الصورة</th>
          <th>الاسم</th>
          <th>البريد الإلكتروني</th>
          <th>موقع المكتب</th>
          <th>التخصص</th>
        </tr>
      </thead>
      <tbody>
        <tr class="public_managment">
          <td><img src="images/Academicpics/JumanaZoubi.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/jumana-al-zoubi-015032253?original_referer=https%3A%2F%2Fwww.google.com%2F" target="_blank">جمانة زياد الزعبي</a></td>
          <td><a href="mailto:j.zoubi@ju.edu.jo">j.zoubi@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>الإدارة العامة</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/mahmoudmaqableh.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/mahmoudmaqableh?trk=people-guest_people_search-card" target="_blank">محمود محمد مقابلة</a></td>
          <td><a href="mailto:maqableh@ju.edu.jo">maqableh@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق ألاول</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/hazarhmoud.jpg" alt="Profile"></td>
          <td><a href="https://uk.linkedin.com/in/dr-hazar-hmoud-6a7b33a" target="_blank">هزار ياسر الحمود</a></td>
          <td><a href="mailto:h.hmoud@ju.edu.jo">h.hmoud@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق السفلي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/الدلاهمة.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/dr-mahmoud-al-dalahmeh-38307825?trk=people-guest_people_search-card" target="_blank">محمود علي الدلاهمة</a></td>
          <td><a href="mailto:m.aldalahmeh@ju.edu.jo">m.aldalahmeh@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/Laila.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/lailaalidahabiyeh" target="_blank">ليلى علي ذهيبة</a></td>
          <td><a href="mailto:laila.dahabiyeh@ju.edu.jo">laila.dahabiyeh@ju.edu.jo</a></td>
          <td>مبنى 1 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="marketing">
          <td><img src="images/Academicpics/هاني-الضمور.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/hani-al-dmour-32643638?original_referer=https%3A%2F%2Fwww.google.co.uk%2F" target="_blank">هاني حامد الضمور</a></td>
          <td><a href="mailto:dmourh@ju.edu.jo">dmourh@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>التسويق</td>
        </tr>
        <tr class="marketing">
          <td><img src="images/Academicpics/زيد-عبيدات.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/dr-zaid-obeidat-9b933088" target="_blank">زيد محمد عبيدات</a></td>
          <td><a href="mailto:z.obeidat@ju.edu.jo">z.obeidat@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأول</td>
          <td>التسويق</td>
        </tr>
        <tr class="marketing">
          <td><img src="images/Academicpics/رامي-دويري.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/rami-aldweeri-b5061ba2/" target="_blank">رامي محمد الدويري</a></td>
          <td><a href="mailto:r.dweeri@ju.edu.jo">r.dweeri@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأول</td>
          <td>التسويق</td>
        </tr>
        <tr class="marketing">
          <td><img src="images/Academicpics/Ayat.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/ayat-almahmoud-a94b5b212/" target="_blank">آيات مازن المحمود</a></td>
          <td><a href="mailto:a.alhawary@ju.edu.jo">a.alhawary@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق السفلي</td>
          <td>التسويق</td>
        </tr>
        <tr class="marketing">
          <td><img src="images/Academicpics/Farahb.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/farah-shishan-ph-d-424b0310b/" target="_blank">فرح ملك شيشان</a></td>
          <td><a href="mailto:f.shishan@ju.edu.jo">f.shishan@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق السفلي</td>
          <td>التسويق</td>
        </tr>
        <tr class="marketing">
          <td><img src="images/Academicpics/DanaKakeesh.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/dana-kakeesh" target="_blank">دانا فوزي قاقيش</a></td>
          <td><a href="mailto:Dana.Kakeesh@ju.edu.jo">Dana.Kakeesh@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>التسويق</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/معتز-الدبعي.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/checkpoint/challengesV2/AQFrouowLBxFwQAAAZFpcuxtQez4JaVI0NL6e0IOi5uSsXMREoQXVpJyLqVAvNezzrdBztsWck9xiE5IwyZbJNrxz1ZvI92RIg?original_referer=https%3A%2F%2Fwww.linkedin.com%2F" target="_blank">معتز محمد الدبعي</a></td>
          <td><a href="mailto:m.aldebei@ju.edu.jo">m.aldebei@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/ashraf.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/ashrafbany" target="_blank">اشرف عادل بني محمد</a></td>
          <td><a href="mailto:a.bany@ju.edu.jo">a.bany@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/rand-aldmour.jpg" alt="Profile"></td>
          <td><a href="https://uk.linkedin.com/in/rand-aldmour-29a19728" target="_blank">رند هاني الضمور</a></td>
          <td><a href="mailto:Rand.aldmour@ju.edu.jo">Rand.aldmour@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/محمد-النوايسة.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/mohammad-al-nawayseh-5465461a?trk=people-guest_people_search-card" target="_blank">محمد خالد النوايسة</a></td>
          <td><a href="mailto:m.nawaiseh@ju.edu.jo">m.nawaiseh@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/AsmaJdaitawe.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/asma-jdaitawi-22285959" target="_blank">أسماء محمد جديتاوي (رئيس قسم)</a></td>
          <td><a href="mailto:a.jdaitawi@ju.edu.jo">a.jdaitawi@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق السفلي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/RifatShannak.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/rifat-o-shannak-27747114" target="_blank">رفعت عودة الله الشناق</a></td>
          <td><a href="mailto:rshannak@ju.edu.jo">rshannak@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="mis">
          <td><img src="images/Academicpics/رائد-مساعده.jpg" alt="Profile"></td>
          <td><a href="http://linkedin.com/in/ra-ed-masa-deh-0766a022" target="_blank">رائد مساعده بني ياسين</a></td>
          <td><a href="mailto:r.masadeh@ju.edu.jo">r.masadeh@ju.edu.jo</a></td>
          <td>مبنى 1 الطابق الأرضي</td>
          <td>نظم المعلومات الإدارية</td>
        </tr>
        <tr class="accounting">
          <td><img src="images/Academicpics/بشير-خميس.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/basheer-khamees-051593267/" target="_blank">بشير أحمد خميس</a></td>
          <td><a href="mailto:basheer@ju.edu.jo">basheer@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>المحاسبة</td>
        </tr>
        <tr class="accounting">
          <td><img src="images/Academicpics/ahmad12.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/ahmad-ahmad-a813a0267" target="_blank">احمد لطفي احمد</a></td>
          <td><a href="mailto:a.jitawi@ju.edu.jo">a.jitawi@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>المحاسبة</td>
        </tr>
        <tr class="accounting">
          <td><img src="images/Academicpics/بتول-بسام.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/batool-abdeldayem-ph-d-738615267/" target="_blank">بتول بسام عبد الدايم</a></td>
          <td><a href="mailto:b.Abdeldayem@ju.edu.jo">b.Abdeldayem@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الأرضي</td>
          <td>المحاسبة</td>
        </tr>
        <tr class="accounting">
          <td><img src="images/Academicpics/عمر-الموافي.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/omar-mowafi-phd-cma-fmva-7a518322b/" target="_blank">عمر تيسير موافي (رئيس القسم)</a></td>
          <td><a href="mailto:o.mowafi@ju.edu.jo">o.mowafi@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الأرضي</td>
          <td>المحاسبة</td>
        </tr>
        <tr class="accounting">
          <td><img src="images/Academicpics/ياسر-اللوزي.jpg" alt="Profile"></td>
          <td><a href="https://uk.linkedin.com/in/dr-yaser-allozi-134284103" target="_blank">ياسر محمد اللوزي</a></td>
          <td><a href="mailto:y.allozi@ju.edu.jo">y.allozi@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>المحاسبة</td>
        </tr>
        <tr class="accounting">
          <td><img src="images/Academicpics/امنه-خميس.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/dr-amneh-hamad-21684316b/" target="_blank">آمنة خميس حمد</a></td>
          <td><a href="mailto:a.hamad@ju.edu.jo">a.hamad@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>المحاسبة</td>
        </tr>
        <tr class="economics">
          <td><img src="images/Academicpics/YaseenAltarawneh.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/yaseen-altarawneh-phd-associate-professor-of-economics-88158430/" target="_blank">ياسين ممدوح الطراونة</a></td>
          <td><a href="mailto:y.tarawneh@ju.edu.jo">y.tarawneh@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الأرضي</td>
          <td>الاقتصاد</td>
        </tr>
        <tr class="finance">
          <td><img src="images/Academicpics/هديل-الياسين.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/hadeel-yaseen-15413921" target="_blank">هديل صلاح ياسين</a></td>
          <td><a href="mailto:h.yaseen@ju.edu.jo">h.yaseen@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الاول</td>
          <td>التمويل</td>
        </tr>
        <tr class="finance">
          <td><img src="images/Academicpics/خطايبه.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/mohammad-khataybeh-314308112" target="_blank">محمد عبدالله الخطايبه</a></td>
          <td><a href="mailto:khataybeh@ju.edu.jo">khataybeh@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الاول</td>
          <td>التمويل</td>
        </tr>
        <tr class="finance">
          <td><img src="images/Academicpics/دعاء-شبيطة.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/dua-a-shubita-847ba4267" target="_blank">دعاء فوزي شبيطة</a></td>
          <td><a href="mailto:d.shubita@ju.edu.jo">d.shubita@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الاول</td>
          <td>التمويل</td>
        </tr>
        <tr class="finance">
          <td><img src="images/Academicpics/سالم-الزيادات.jpg" alt="Profile"></td>
          <td><a href="https://ca.linkedin.com/in/salem-ziadat-3a15b244?trk=people-guest_people_search-card" target="_blank">سالم عادل الزيادات</a></td>
          <td><a href="mailto:s.ziadat@ju.edu.jo">s.ziadat@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الاول</td>
          <td>التمويل</td>
        </tr>
        <tr class="finance">
          <td><img src="images/Academicpics/Majd.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/majd-iskandrani-0199735a" target="_blank">مجد منير اسكندراني</a></td>
          <td><a href="mailto:m.iskandrani@ju.edu.jo">m.iskandrani@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الاول</td>
          <td>التمويل</td>
        </tr>
        <tr class="finance">
          <td><img src="images/Academicpics/مهند-عبيدات.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/muhannad-obeidat-22a86285" target="_blank">مهند حسين عبيدات</a></td>
          <td><a href="mailto:Obeidatmohanned@yahoo.com">Obeidatmohanned@yahoo.com</a></td>
          <td>مبنى 2 الطابق الاول</td>
          <td>التمويل</td>
        </tr>
        <tr class="economics">
          <td><img src="images/Academicpics/nora-abu-asab.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/nora-h-abu-asab-60726027/" target="_blank">نورا حامد ابو رعب</a></td>
          <td><a href="mailto:n.abuasab@ju.edu.jo">n.abuasab@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الاول</td>
          <td>الاقتصاد</td>
        </tr>
        <tr class="economics">
          <td><img src="images/Academicpics/خوله-علي.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/khawlah-abdalla-spetan-9b8a9a22/" target="_blank">خوله علي سبيتان</a></td>
          <td><a href="mailto:Khawlah.Spetan@ju.edu.jo">Khawlah.Spetan@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الاول</td>
          <td>الاقتصاد</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/زياد-كلحه.jpg" alt="Profile"></td>
          <td><a href="https://uk.linkedin.com/in/ziad-al-kalha-3415043b" target="_blank">زياد سامي الكلحة</a></td>
          <td><a href="mailto:z.kalha@ju.edu.jo">z.kalha@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/تغريد-سعيفان .jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/dr-taghrid-suifan-a5aa5785/ar?trk=people-guest_people_search-card" target="_blank">تغريد صالح سعيفان</a></td>
          <td><a href="mailto:t.suifan@ju.edu.jo">t.suifan@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الاول</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/AymanAbdullah.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/ayman-bahjat-abdallah-27b78b29" target="_blank">أيمن بهجت عبدالله</a></td>
          <td><a href="mailto:a.abdallah@ju.edu.jo">a.abdallah@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الاول</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/motasemThunaibat.jpg" alt="Profile"></td>
          <td><a href="https://uk.linkedin.com/in/motasem-m-thneibat-b9054951?trk=public_profile_browsemap" target="_blank">معتصم محمد الذنيبات (رئيس القسم)</a></td>
          <td><a href="mailto:Motasem.thneibat@ju.edu.jo">Motasem.thneibat@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الاول</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/ريما.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/rima-al-hasan-mba-phd" target="_blank">ريما وحيد الحسن</a></td>
          <td><a href="mailto:r.hasan@ju.edu.jo">r.hasan@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/Dr.Samer.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/dr-samer-dahiyat-04a47714" target="_blank">سامر عيد الدحيات</a></td>
          <td><a href="mailto:s.dahiyat@ju.edu.jo">s.dahiyat@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الأرضي</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/نيفين.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/niveen-alasayyed-563bbb20b?trk=public_profile_browsemap" target="_blank">نيفين مازن السيد</a></td>
          <td><a href="mailto:n.alsayed@ju.edu.jo">n.alsayed@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/زعبي-الزعبي.jpg" alt="Profile"></td>
          <td><a href="https://au.linkedin.com/in/professor-dr-zu-bi-al-zu-bi-phd-dunelm-fhea-7273a42" target="_blank">زعبي محمد الزعبي</a></td>
          <td><a href="mailto:z.alzubi@ju.edu.jo">z.alzubi@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>الإدارة</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/راتب-صويص.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/rateb-sweis-9269113" target="_blank">راتب جليل صويص</a></td>
          <td><a href="mailto:r.sweis@ju.edu.jo">r.sweis@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الاول</td>
          <td>الإدارة</td>
        </tr>
        <tr class="economics">
          <td><img src="images/Academicpics/علاء-طراونة.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/alaaeddin-al-tarawneh-877178b3" target="_blank">علاء الدين عوض الطراونة</a></td>
          <td><a href="mailto:a.altarawneh@ju.edu.jo">a.altarawneh@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الاول</td>
          <td>الاقتصاد</td>
        </tr>
        <tr class="economics">
          <td><img src="images/Academicpics/profnaheel.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/nahil-saqfalhait-316a1014/?originalSubdomain=jo" target="_blank">نهيل اسماعيل سقف الحيط</a></td>
          <td><a href="mailto:nahil.saqfalhait@ju.edu.jo">nahil.saqfalhait@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الاول</td>
          <td>الاقتصاد</td>
        </tr>
        <tr class="marketing">
          <td><img src="images/Academicpics/محمد-المومني.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/mohammad-atef-al-momani-aa17b766?utm_source=share&amp;utm_campaign=share_via&amp;utm_content=profile&amp;utm_medium=ios_app" target="_blank">محمد عاطف المومني</a></td>
          <td><a href="mailto:mo.almomani@ju.edu.jo">mo.almomani@ju.edu.jo</a></td>
          <td>مبنى 2 الطابق الاول</td>
          <td>التسويق</td>
        </tr>
        <tr class="business">
          <td><img src="images/Academicpics/ahmadobeidat.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/dr-ahmad-obeidat-b73318213" target="_blank">احمد محمد عبيدات</a></td>
          <td><a href="mailto:a.obeidat@ju.edu.jo">a.obeidat@ju.edu.jo</a></td>
          <td>مبنى 4 الطابق الاول</td>
          <td>الإدارة</td>
        </tr>
        <tr class="public_managment">
          <td><img src="images/Academicpics/AboFares.jpg" alt="Profile"></td>
          <td><a href="https://academic.ju.edu.jo/m.abufares/default.aspx" target="_blank">محمود عوده أبو فارس</a></td>
          <td><a href="mailto:m.abufares@ju.edu.jo">m.abufares@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>الإدارة العامة</td>
        </tr>
        <tr class="public_managment">
          <td><img src="images/Academicpics/اخورشيده.jpg" alt="Profile"></td>
          <td><a href="https://jo.linkedin.com/in/abdel-hakim-akhorshaideh-473b1527a" target="_blank">عبد الحكيم عقلة اخو ارشيدة</a></td>
          <td><a href="mailto:a.hakim@ju.edu.jo">a.hakim@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>الإدارة العامة</td>
        </tr>
        <tr class="accounting">
          <td><img src="images/Academicpics/ahmad12.jpg" alt="Profile"></td>
          <td><a href="https://www.linkedin.com/in/ghaleb-abu-rummn-a3b8a991/" target="_blank">غالب محمد أبو رمان</a></td>
          <td><a href="mailto:g.aburumman@ju.edu.jo">g.aburumman@ju.edu.jo</a></td>
          <td>مبنى 3 الطابق الأرضي</td>
          <td>المحاسبة</td>
        </tr>
      </tbody>
    </table>
  </div>

<!-- Image Modal -->
<div id="imgModal">
  <div class="modal-content">
    <button class="close-btn">&times;</button>
    <img src="" alt="Profile Picture">
  </div>
</div>

<!-- footer import -->
    <?php include 'includes/footer.php'; ?>

  <!-- JavaScript for Search + Filter -->
  <script>
    const searchInput  = document.getElementById('tableSearch');
    const filterSelect = document.getElementById('majorFilter');

    function applyFilters() {
      const major   = filterSelect.value;
      const keyword = searchInput.value.trim().toLowerCase();
      document.querySelectorAll('tbody tr').forEach(row => {
        const matchesMajor = major === 'all' || row.classList.contains(major);
        const text        = row.textContent.trim().toLowerCase();
        const matchesText = !keyword || text.includes(keyword);
        if (matchesMajor && matchesText) {
          row.classList.remove('hidden');
        } else {
          row.classList.add('hidden');
        }
      });
    }

    filterSelect.addEventListener('change', applyFilters);
    searchInput.addEventListener('input',  applyFilters);
  </script>


  <!-- to toggle their picture  -->
  <script>
const imgModal = document.getElementById('imgModal');
const modalImg = imgModal.querySelector('img');
const closeBtn = imgModal.querySelector('.close-btn');

document.querySelectorAll('.table img').forEach(thumbnail => {
  thumbnail.style.cursor = 'pointer';
  thumbnail.addEventListener('click', () => {
    // Use the raw src attribute (respects your <base href>)
    modalImg.src = thumbnail.getAttribute('src');
    imgModal.classList.add('show');
  });
});

closeBtn.addEventListener('click', () => {
  imgModal.classList.remove('show');
  modalImg.src = '';  // clear it out if you want
});

// clicking outside the image also closes
imgModal.addEventListener('click', e => {
  if (e.target === imgModal) {
    imgModal.classList.remove('show');
    modalImg.src = '';
  }
});
</script>



         <!-- for grey menu js all pages  -->
<script src="js/grey.js?v=<?= time(); ?>"></script>


 

    </body>
    </html>
