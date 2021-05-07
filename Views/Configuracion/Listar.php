<?php
encabezado();
?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Reportes desde una fecha hasta otra: </h2>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                      <form class="form-inline" action="verReporte" method="post" target="_blank">
                        <label >Desde &nbsp;</label>
                        <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" name="desde" placeholder="Desde">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          <div class="input-group-addon"></div>
                          <label >Hasta &nbsp;</label>
                          <input type="date" class="form-control" id="inlineFormInputGroup" name="hasta" placeholder="Hasta">
                        </div>
                   <div class="form-check mb-2 mr-sm-2 mb-sm-0"></div>
                   <button type="submit" class="btn btn-primary">Generar</button>
                  </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
pie();
?>
