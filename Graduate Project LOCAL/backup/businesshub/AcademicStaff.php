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
        
    
     
        body {
  
            background-color: #FAF9F6;
         
        }
        .table img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;

        }
 
        .btn-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn-group .btn {
            margin: 5px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>

<body>

<?php include 'includes/header.php'; ?>

    <!-- Major Selection Buttons -->
    <div class="container text-center my-3">
        <div class="btn-group">
            <button class="btn btn-primary" onclick="filterTable('all')">عرض الكل</button>
            <button class="btn btn-outline-secondary" onclick="filterTable('mis')">نظم المعلومات الإدارية</button>
            <button class="btn btn-outline-secondary" onclick="filterTable('business')">إدارة الأعمال</button>
            <button class="btn btn-outline-secondary" onclick="filterTable('marketing')">التسويق</button>
            <button class="btn btn-outline-secondary" onclick="filterTable('accounting')">المحاسبة</button>
            <button class="btn btn-outline-secondary" onclick="filterTable('finance')">التمويل</button>
            <button class="btn btn-outline-secondary" onclick="filterTable('economics')">الاقتصاد</button>
            <button class="btn btn-outline-secondary" onclick="filterTable('public_managment')"> الإدارة العامة</button>
        </div>
    </div>

    <!-- Table -->
    <div class="container">
        <table class="table table-bordered table-striped bg-white">
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
                    <td>جمانة زياد الزعبي</td>
                    <td><a href="mailto:j.zoubi@ju.edu.jo ">j.zoubi@ju.edu.jo </a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>الإدارة العامة </td>
                </tr>
                <tr class="mis">
                <td><img src="images/Academicpics/mahmoudmaqableh.jpg" alt="Profile"></td>
                    <td>محمود محمد مقابلة</td>
                    <td><a href="mailto:maqableh@ju.edu.jo ">maqableh@ju.edu.jo </a></td>
                    <td>مبنى 4 الطابق ألاول</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/hazarhmoud.jpg" alt="Profile"></td>
                    <td>هزار ياسر الحمود</td>
                    <td><a href="mailto:h.hmoud@ju.edu.jo">h.hmoud@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق السفلي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/الدلاهمة.jpg" alt="Profile"></td>
                    <td>محمود علي الدلاهمة</td>
                    <td><a href="mailto: m.aldalahmeh@ju.edu.jo  "> m.aldalahmeh@ju.edu.jo  </a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/Laila.jpg" alt="Profile"></td>
                    <td>ليلى علي ذهيبة</td>
                    <td> <a href="mailto: laila.dahabiyeh@ju.edu.jo"> laila.dahabiyeh@ju.edu.jo</a></td>
                    <td>مبنى 1 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="marketing">
                    <td><img src="images/Academicpics/هاني-الضمور.jpg" alt="Profile"></td>
                    <td>هاني حامد الضمور</td>
                    <td><a href="mailto: dmourh@ju.edu.jo "> dmourh@ju.edu.jo </a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>التسويق</td>
                </tr>
                <tr class="marketing">
                    <td><img src="images/Academicpics/زيد-عبيدات.jpg" alt="Profile"></td>
                    <td>زيد محمد عبيدات</td>
                    <td><a href="mailto:z.obeidat@ju.edu.jo">z.obeidat@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الأول</td>
                    <td>التسويق</td>
                </tr>
                <tr class="marketing">
                    <td><img src="images/Academicpics/رامي-دويري.jpg" alt="Profile"></td>
                    <td>رامي محمد الدويري</td>
                    <td><a href="mailto:r.dweeri@ju.edu.jo">r.dweeri@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الأول</td>
                    <td>التسويق</td>
                </tr>
                <tr class="marketing">
                    <td><img src="images/Academicpics/Ayat.jpg" alt="Profile"></td>
                    <td>آيات مازن المحمود</td>
                    <td><a href="mailto:a.alhawary@ju.edu.jo">a.alhawary@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق السفلي</td>
                    <td>التسويق</td>
                </tr>
                <tr class="marketing">
                    <td><img src="images/Academicpics/Farahb.jpg" alt="Profile"></td>
                    <td>فرح ملك شيشان</td>
                    <td><a href="mailto:f.shishan@ju.edu.jo">f.shishan@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق السفلي</td>
                    <td>التسويق</td>
                </tr>
                <tr class="marketing">
                    <td><img src="images/Academicpics/DanaKakeesh.jpg" alt="Profile"></td>
                    <td>دانا فوزي قاقيش</td>
                    <td><a href="mailto:Dana.Kakeesh@ju.edu.jo">Dana.Kakeesh@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>التسويق</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/معتز-الدبعي.jpg" alt="Profile"></td>
                    <td>معتز محمد الدبعي</td>
                    <td><a href="mailto:m.aldebei@ju.edu.jo">m.aldebei@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/ashraf.jpg" alt="Profile"></td>
                    <td>اشرف عادل بني محمد</td>
                    <td><a href="mailto:a.bany@ju.edu.jo">a.bany@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/rand-aldmour.jpg" alt="Profile"></td>
                    <td>رند هاني الضمور</td>
                    <td><a href="mailto:Rand.aldmour@ju.edu.jo">Rand.aldmour@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/محمد-النوايسة.jpg" alt="Profile"></td>
                    <td>محمد خالد النوايسة</td>
                    <td><a href="mailto:m.nawaiseh@ju.edu.jo">m.nawaiseh@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/AsmaJdaitawe.jpg" alt="Profile"></td>
                    <td>أسماء محمد جديتاوي (رئيس قسم)</td>
                    <td><a href="mailto:a.jdaitawi@ju.edu.jo">a.jdaitawi@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق السفلي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/RifatShannak.jpg" alt="Profile"></td>
                    <td>رفعت عودة الله الشناق</td>
                    <td><a href="mailto: rshannak@ju.edu.jo "> rshannak@ju.edu.jo </a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="mis">
                    <td><img src="images/Academicpics/رائد-مساعده.jpg" alt="Profile"></td>
                    <td>رائد مساعده بني ياسين</td>
                    <td><a href="mailto:r.masadeh@ju.edu.jo ">r.masadeh@ju.edu.jo </a></td>
                    <td>مبنى 1 الطابق الأرضي</td>
                    <td>نظم المعلومات الإدارية</td>
                </tr>
                <tr class="accounting">
                    <td><img src="images/Academicpics/بشير-خميس.jpg" alt="Profile"></td>
                    <td>بشير أحمد خميس </td>
                    <td><a href="mailto:basheer@ju.edu.jo ">basheer@ju.edu.jo </a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>المحاسبة</td>
                </tr>
                <tr class="accounting">
                    <td><img src="images/Academicpics/ahmad12.jpg" alt="Profile"></td>
                    <td>احمد لطفي احمد</td>
                    <td><a href="mailto:a.jitawi@ju.edu.jo">a.jitawi@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>المحاسبة</td>
                </tr>
                <tr class="accounting">
                    <td><img src="images/Academicpics/بتول-بسام.jpg" alt="Profile"></td>
                    <td> بتول بسام عبد الدايم</td>
                    <td><a href="mailto:b.Abdeldayem@ju.edu.jo">b.Abdeldayem@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الأرضي</td>
                    <td>المحاسبة</td>
                </tr>
                <tr class="accounting">
                    <td><img src="images/Academicpics/عمر-الموافي.jpg" alt="Profile"></td>
                    <td>عمر تيسير موافي (رئيس القسم)</td>
                    <td><a href="mailto:o.mowafi@ju.edu.jo">o.mowafi@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الأرضي</td>
                    <td>المحاسبة</td>
                </tr>
                <tr class="accounting">
                    <td><img src="images/Academicpics/ياسر-اللوزي.jpg" alt="Profile"></td>
                    <td>ياسر محمد اللوزي</td>
                    <td><a href="mailto:y.allozi@ju.edu.jo">y.allozi@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>المحاسبة</td>
                </tr>
                <tr class="accounting">
                    <td><img src="images/Academicpics/امنه-خميس.jpg" alt="Profile"></td>
                    <td>آمنة خميس حمد</td>
                    <td><a href="mailto: a.hamad@ju.edu.jo "> a.hamad@ju.edu.jo </a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>المحاسبة</td>
                </tr>
                <tr class="economics">
                    <td><img src="images/Academicpics/YaseenAltarawneh.jpg" alt="Profile"></td>
                    <td>  ياسين ممدوح الطراونة  </td>
                    <td><a href="mailto:y.tarawneh@ju.edu.jo">y.tarawneh@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الأرضي</td>
                    <td>الاقتصاد</td>
                </tr>
                <tr class="finance">
                    <td><img src="images/Academicpics/هديل-الياسين.jpg" alt="Profile"></td>
                    <td>هديل صلاح ياسين</td>
                    <td><a href="mailto:h.yaseen@ju.edu.jo">h.yaseen@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الاول</td>
                    <td>التمويل</td>
                </tr>
                <tr class="finance">
                    <td><img src="images/Academicpics/خطايبه.jpg" alt="Profile"></td>
                    <td>محمد عبدالله الخطايبه</td>
                    <td><a href="mailto:khataybeh@ju.edu.jo">khataybeh@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الاول</td>
                    <td>التمويل</td>
                </tr>
                <tr class="finance">
                    <td><img src="images/Academicpics/دعاء-شبيطة.jpg" alt="Profile"></td>
                    <td>دعاء فوزي شبيطة</td>
                    <td><a href="mailto:d.shubita@ju.edu.jo">d.shubita@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الاول</td>
                    <td>التمويل</td>
                </tr>
                <tr class="finance">
                    <td><img src="images/Academicpics/سالم-الزيادات.jpg" alt="Profile"></td>
                    <td>سالم عادل الزيادات</td>
                    <td><a href="mailto:s.ziadat@ju.edu.jo">s.ziadat@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الاول</td>
                    <td>التمويل</td>
                </tr>
                <tr class="finance">
                    <td><img src="images/Academicpics/Majd.jpg" alt="Profile"></td>
                    <td>مجد منير اسكندراني</td>
                    <td><a href="mailto: m.iskandrani@ju.edu.jo"> m.iskandrani@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الاول</td>
                    <td>التمويل</td>
                </tr>
                <tr class="finance">
                    <td><img src="images/Academicpics/مهند-عبيدات.jpg" alt="Profile"></td>
                    <td>مهند حسين عبيدات</td>
                    <td><a href="mailto:Obeidatmohanned@yahoo.com">Obeidatmohanned@yahoo.com</a></td>
                    <td>مبنى 2 الطابق الاول</td>
                    <td>التمويل</td>
                </tr>
                <tr class="economics">
                    <td><img src="images/Academicpics/nora-abu-asab.jpg" alt="Profile"></td>
                    <td>نورا حامد ابو عصب</td>
                    <td><a href="mailto:n.abuasab@ju.edu.jo">n.abuasab@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الاول</td>
                    <td>الاقتصاد</td>
                </tr>
                <tr class="economics">
                    <td><img src="images/Academicpics/خوله-علي.jpg" alt="Profile"></td>
                    <td>خوله علي سبيتان</td>
                    <td><a href="mailto:Khawlah.Spetan@ju.edu.jo">Khawlah.Spetan@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الاول</td>
                    <td>الاقتصاد</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/زياد-كلحه.jpg" alt="Profile"></td>
                    <td> زياد سامي الكلحة </td>
                    <td><a href="mailto:z.kalha@ju.edu.jo">z.kalha@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/تغريد-سعيفان .jpg" alt="Profile"></td>
                    <td>تغريد صالح سعيفان</td>
                    <td><a href="mailto:t.suifan@ju.edu.jo">t.suifan@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الاول</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/AymanAbdullah.jpg" alt="Profile"></td>
                    <td>أيمن بهجت عبدالله</td>
                    <td><a href="mailto:a.abdallah@ju.edu.jo">a.abdallah@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الاول</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/motasemThunaibat.jpg" alt="Profile"></td>
                    <td>معتصم محمد الذنيبات (رئيس القسم)</td>
                    <td><a href="mailto:Motasem.thneibat@ju.edu.jo ">Motasem.thneibat@ju.edu.jo </a></td>
                    <td>مبنى 4 الطابق الاول</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/ريما.jpg" alt="Profile"></td>
                    <td>ريما وحيد الحسن</td>
                    <td><a href="mailto: r.hasan@ju.edu.jo "> r.hasan@ju.edu.jo </a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/Dr.Samer.jpg" alt="Profile"></td>
                    <td>سامر عيد الدحيات</td>
                    <td><a href="mailto: s.dahiyat@ju.edu.jo "> s.dahiyat@ju.edu.jo </a></td>
                    <td>مبنى 4 الطابق الأرضي</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/نيفين.jpg" alt="Profile"></td>
                    <td>نيفين مازن السيد</td>
                    <td><a href="mailto:n.alsayed@ju.edu.jo">n.alsayed@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/زعبي-الزعبي.jpg" alt="Profile"></td>
                    <td>زعبي محمد الزعبي</td>
                    <td><a href="mailto:z.alzubi@ju.edu.jo ">z.alzubi@ju.edu.jo </a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/راتب-صويص.jpg" alt="Profile"></td>
                    <td>راتب جليل صويص</td>
                    <td><a href="mailto:r.sweis@ju.edu.jo">r.sweis@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الأول</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="economics">
                    <td><img src="images/Academicpics/علاء-طراونة.jpg" alt="Profile"></td>
                    <td> علاء الدين عوض الطراونة </td>
                    <td><a href="mailto:a.altarawneh@ju.edu.jo">a.altarawneh@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الاول</td>
                    <td>الاقتصاد</td>
                </tr>
                <tr class="economics">
                    <td><img src="images/Academicpics/profnaheel.jpg" alt="Profile"></td>
                    <td>  نهيل اسماعيل سقف الحيط</td>
                    <td><a href="mailto:nahil.saqfalhait@ju.edu.jo  ">nahil.saqfalhait@ju.edu.jo  </a></td>
                    <td>مبنى 2 الطابق الاول</td>
                    <td>الاقتصاد</td>
                </tr>
                <tr class="marketing">
                    <td><img src="images/Academicpics/محمد-المومني.jpg" alt="Profile"></td>
                    <td> محمد عاطف المومني </td>
                    <td><a href="mailto:mo.almomani@ju.edu.jo">mo.almomani@ju.edu.jo</a></td>
                    <td>مبنى 2 الطابق الاول</td>
                    <td>التسويق</td>
                </tr>
                <tr class="business">
                    <td><img src="images/Academicpics/ahmadobeidat.jpg" alt="Profile"></td>
                    <td>  احمد محمد عبيدات </td>
                    <td><a href="mailto:a.obeidat@ju.edu.jo">a.obeidat@ju.edu.jo</a></td>
                    <td>مبنى 4 الطابق الاول</td>
                    <td>الإدارة</td>
                </tr>
                <tr class="public_managment"> 
                    <td><img src="images/Academicpics/AboFares.jpg" alt="Profile"></td>
                    <td> محمود عوده أبو فارس </td>
                    <td><a href="mailto: m.abufares@ju.edu.jo "> m.abufares@ju.edu.jo </a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>الإدارة العامة </td>
                </tr>
                <tr class="public_managment"> 
                    <td><img src="images/Academicpics/اخورشيده.jpg" alt="Profile"></td>
                    <td>  عبد الحكيم عقلة اخو ارشيدة </td>
                    <td><a href="mailto:a.hakim@ju.edu.jo">a.hakim@ju.edu.jo</a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>الإدارة العامة </td>
                </tr>
                <tr class="accounting">
                    <td><img src="images/Academicpics/ahmad12.jpg" alt="Profile"></td>
                    <td> غالب محمد أبو رمان  </td>
                    <td><a href="mailto: g.aburumman@ju.edu.jo "> g.aburumman@ju.edu.jo </a></td>
                    <td>مبنى 3 الطابق الأرضي</td>
                    <td>المحاسبة</td>
            </tbody>
        </table>
    </div>

<!-- footer import -->
    <?php include 'includes/footer.php'; ?>

   <!-- JavaScript for Filtering -->
   <script>
        function filterTable(major) {
            let rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                if (major === "all") {
                    row.classList.remove("hidden");
                } else {
                    row.classList.add("hidden");
                    if (row.classList.contains(major)) {
                        row.classList.remove("hidden");
                    }
                }
            });
        }
    </script>
         <!-- for grey menu js all pages  -->
<script src="js/grey.js?v=<?= time(); ?>"></script>


 

    </body>
    </html>
