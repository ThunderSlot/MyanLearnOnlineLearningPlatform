

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Course | MyanLearn Instructor</title>

    <!-- Main Css File -->
    <link rel="stylesheet" href="assets/css/instructordashboard.css">
    <link rel="stylesheet" href="assets/css/createNewCourse.css">
    <link rel="stylesheet" href="assets/css/variable.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="assets/css/variable.css">

     <!-- For icon tab -->
     <link rel="icon" href="assets/images/logomobile.png">

     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">

    <!-- Vendor -->
    <link href="assets\vendor\bootstrap\css\bootstrap.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">



</head>
<body>



<section class="home">
    <div class="text"></div>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><i class="fa-solid fa-folder-plus" style="margin-right: 5px;"></i>Curriculum</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="instructordashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Create Curriculum</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="formSteps">
            <!-- Progress bar -->
            <div class="progressbar">
                <div class="progress" id="progress" style="width:33.333%;"></div>
                
                <div class="progress-step progress-step-active" data-title="Intro"></div>
                <div class="progress-step progress-step-active" data-title="Curriculum"></div>
                <div class="progress-step" data-title="Media"></div>
                <div class="progress-step" data-title="Price"></div>
            </div>

           <form action="createCurriculum.php" method="post" enctype="multipart/form-data" class="form">
                <div class="form-step form-step-active">               

                    <div class="tab-info">
                        <h3 class="tab-title">Curriculum Form</h3>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="curriculum-add-item">
                            <h4 class="section-title mt-0"><i class="fas fa-th-list mr-2"></i>Curriculum</h4>
                            <button class="main-btn color btn-hover ml-left" data-toggle="modal" data-target="#add_section_model">New Section</button>
                        </div>        
                    </div>

                    <div class="form-fillup">
                        
                        <div class="col-md-12">
                            
                        </div>


                    </div>
                    
                </div>
           </form>
        

           
        </div>

        

    </main><!-- End #main -->

</section>





<script>
const modeSwitch = document.getElementById('modeSwitch');
const toggle = document.querySelector('.toggle');
const sidebar = document.querySelector('.sidebar');
const modeText = document.querySelector('.mode-text');

modeSwitch.addEventListener("click", ()=>{
    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark"))
    {
        modeText.innerText = "Light Mode"   
    }
    else {modeText.innerText = "Dark Mode" }

});

toggle.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
    document.querySelector('.logoMobile2').classList.toggle('hide');
    document.querySelector('.logoDefault').classList.toggle('hide');
});



</script>

<script>
        const modeSwitch = document.getElementById('modeSwitch');
        const toggle = document.querySelector('.toggle');
        const sidebar = document.querySelector('.sidebar');
        const modeText = document.querySelector('.mode-text');

        modeSwitch.addEventListener("click", ()=>{
            document.body.classList.toggle("dark");

            if(document.body.classList.contains("dark"))
            {
                modeText.innerText = "Light Mode"   
            }
            else {modeText.innerText = "Dark Mode" }

        });

        toggle.addEventListener("click", ()=>{
            sidebar.classList.toggle("close");
            document.querySelector('.logoMobile2').classList.toggle('hide');
            document.querySelector('.logoDefault').classList.toggle('hide');
        });



    </script>


</body>
</html>