@extends('layouts.userLayouts')
@section('content')
    <!-- ===== PAGE CONTENT ===== -->
    <div class="page-section">

        <!-- BREADCRUMB -->
        <div class="breadcrumb-custom" id="breadcrumb"></div>

        <!-- TOP DETAIL -->
        <div class="genset-top">
            <div class="powered-wrap">
                <div class="powered-text">Powered by:</div>
                <div class="powered-logo">
                    <img id="brandLogo" alt="Brand Logo">
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="spec-title">APP Series Specifications</div>
        <div class="table-responsive">
            <table class="table table-bordered table-spec">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Engine</th>
                        <th>Alternator</th>
                        <th>KVA</th>
                        <th>KW</th>
                        <th>Fuel (L/H)</th>
                    </tr>
                </thead>
                <tbody id="specBody"></tbody>
            </table>
        </div>


    </div>

    </div>

<script>
/* ================= BRAND DATA ================= */
const brandData = {
    himoinsa:{name:"Himoinsa",logo:"img/brand/himoinsa.png"},
    perkins:{name:"Perkins",logo:"img/brand/perkins.png"},
    kubota:{name:"Kubota",logo:"img/brand/kubota.png"},
    yanmar:{name:"Yanmar",logo:"img/brand/yanmar.png"},
    cummins:{name:"Cummins",logo:"img/brand/cummins.png"},
    doosan:{name:"Doosan",logo:"img/brand/doosan.png"},
    mitsubishi:{name:"Mitsubishi",logo:"img/brand/mitsubishi.png"},
    mtu:{name:"MTU",logo:"img/brand/mtu.png"},
    fpt:{name:"FPT Iveco",logo:"img/brand/fpt.png"}
};

/* ================= GET BRAND ================= */
const params = new URLSearchParams(window.location.search);
const key = params.get("brand");
const brand = brandData[key] || brandData["perkins"];

/* ================= SET UI ================= */
document.getElementById("breadcrumb").innerHTML =
    `Genset / <strong>${brand.name}</strong> / Capacity`;

document.getElementById("brandLogo").src = brand.logo;

/* ================= TABLE DATA ================= */
const rows = [
    ["APP10","4030x11G","PI044E",10,8,2.8],
    ["APP20","4030x11G","PI044E",20,16,5.3],
    ["APP30","4030x11G","PI044E",30,24,7.2]
];

const tbody = document.getElementById("specBody");
rows.forEach(r=>{
    tbody.innerHTML += `
    <tr>
        <td>${r[0]}</td>
        <td>${r[1]}</td>
        <td>${r[2]}</td>
        <td>${r[3]}</td>
        <td>${r[4]}</td>
        <td>${r[5]}</td>
    </tr>`;
});
</script>
@endsection