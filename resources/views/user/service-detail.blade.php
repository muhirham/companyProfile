@extends('layouts.userLayouts')
@section('content')
    <!-- ===== PAGE CONTENT ===== -->
    <div class="page-section">

        <!-- Breadcrumb -->
        <div class="breadcrumb-custom">
            <a href="service.html">Service</a> /
            <span id="breadcrumb"></span>
        </div>

        <!-- Image -->
        <img id="serviceImg" class="service-img" alt="Service Image">

        <!-- Title -->
        <div class="service-title mt-3" id="serviceTitle"></div>

        <!-- Description -->
        <p class="service-desc mt-3" id="serviceDesc"></p>

        <!-- Steps -->
        <h6 class="mt-4">Tahapan Pekerjaan:</h6>
        <ul class="step-list" id="serviceSteps"></ul>
    </div>

</div>

<script>
/* ================= SERVICE DATA ================= */
const serviceData = {
    installation:{
        title:"Installation",
        image:"imgGenset/1.jpg",
        desc:"Layanan instalasi genset profesional dengan standar keselamatan tinggi untuk memastikan genset siap digunakan secara optimal.",
        steps:[
            "Survey lokasi dan kebutuhan daya",
            "Persiapan fondasi dan sistem kelistrikan",
            "Pemasangan genset dan panel kontrol",
            "Testing & commissioning",
            "Serah terima dan dokumentasi"
        ]
    },
    maintenance:{
        title:"Maintenance",
        image:"imgGenset/2.jpg",
        desc:"Perawatan genset secara berkala untuk menjaga performa mesin dan memperpanjang usia pakai.",
        steps:[
            "Pemeriksaan visual dan sistem",
            "Penggantian oli dan filter",
            "Pengecekan sistem pendingin",
            "Pengujian beban genset",
            "Pembuatan laporan maintenance"
        ]
    },
    rental:{
        title:"Rental",
        image:"imgGenset/3.jpg",
        desc:"Penyewaan genset untuk proyek, event, dan kondisi darurat dengan dukungan teknis penuh.",
        steps:[
            "Konsultasi kebutuhan daya",
            "Pengiriman genset ke lokasi",
            "Instalasi dan pengujian",
            "Support teknisi selama masa sewa",
            "Pembongkaran setelah selesai"
        ]
    }
};

/* ================= LOAD DATA ================= */
const params = new URLSearchParams(window.location.search);
const type = params.get("type");
const data = serviceData[type];

if(data){
    document.getElementById("breadcrumb").innerText = data.title;
    document.getElementById("serviceTitle").innerText = data.title;
    document.getElementById("serviceDesc").innerText = data.desc;
    document.getElementById("serviceImg").src = data.image;

    const steps = document.getElementById("serviceSteps");
    data.steps.forEach(s=>{
        steps.innerHTML += `<li>${s}</li>`;
    });
}else{
    document.querySelector(".page-section").innerHTML =
        "<p>Service tidak ditemukan.</p>";
}
</script>
@endsection