<div class="header bg-primary pb-8 pt-5 pt-md-8 align-items-center">
    <div class="container-fluid">
        {{-- <div class="alert alert-danger" role="alert">
            <strong>This is a PRO feature!</strong>
        </div> --}}
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total des entrées</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ number_format($entries_sum) }} FCFA</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total des sorties</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ number_format($outings_sum) }} FCFA</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last week</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Solde</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ number_format($balance) }} FCFA</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last week</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total des utilisateurs</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $users_sum }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Since last week</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- This section is for Oppme --}}
            {{--<div class="row mt-2">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total des entrées TTC</h5>
                                    <span class="h2 font-weight-bold mb-0"><span id="total_ca_ttc"></span> FCFA</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total des entrées HT</h5>
                                    <span class="h2 font-weight-bold mb-0"><span id="total_ca_ht"></span> FCFA</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total de la TVA Facturée</h5>
                                    <span class="h2 font-weight-bold mb-0"><span id="total_tva"></span> FCFA</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
    let facture_count = document.getElementById('factures_count')
    let total_ca_ht = document.getElementById('total_ca_ht')
    let total_ca_ttc = document.getElementById('total_ca_ttc')
    let total_tva = document.getElementById('total_tva')



    function get_facture_amount(bearer_token) {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/gestcaisse/factures/amounts',
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': bearer_token,

            },
            contentType: 'application/json; charset=utf-8',
            success: function(result) {
                //    facture_count.innerHTML = result
                total_ca_ht.innerHTML = result.total_ca_ht
                total_ca_ttc.innerHTML = result.total_ca_ttc
                total_tva.innerHTML = result.total_tva
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    $.ajax({
        url: 'http://127.0.0.1:8000/api/gestcaisse/auth/token',
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function(result) {
            let token = result
            get_facture_amount(token)
        }

    })
</script>
