<div class="card ">
  <h4 class="m-3">Antecedentes</h4>
  <hr class="dropdown-divider m-2">
  <div class="accordion m-2" id="accordionEstudios">

    <div class="accordion-item bg-acordion">
      <h2 class="accordion-header" id="collappatologicos">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePatologicosTarget" aria-expanded="false" aria-controls="accordionEstudios">
          <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Antecedentes patológicos
        </button>
      </h2>
      <div id="collapsePatologicosTarget" class="accordion-collapse collapse" aria-labelledby="collappatologicos">
        <div class="accordion-body">
          <div class="row"style="zoom:110%;margin-left:5%;width: 70%">
            <div class="col-6">
              <label for="" >Hospitalización previa: </label>
            </div>
            <div class="col-3">
              <input type="radio" id="pato-HP" name="Pato-HP" value="1" required  onclick="collapse('#CollapsePato-HP', true)">
              <label for="pato-HP">Si</label>
            </div>
            <div class="col-3">
              <input type="radio"  id="pato-HP" name="Pato-HP" value="0" required onclick="collapse('#CollapsePato-HP', false)">
              <label for="pato-HP" >No</label>
            </div>
            <div class="collapse" id="CollapsePato-HP">
              <textarea name="name" class="form-control input-form" rows="2" cols="2" placeholder="Comentario..."></textarea>
            </div>
          </div>
          <div class="row"style="zoom:110%;margin-left:5%;width: 70%">
            <div class="col-6">
              <label for="" >CIRUGIAS PREVIAS: </label>
            </div>
            <div class="col-3">
              <input type="radio" id="pato-CR" name="Pato-CR" value="1" required  onclick="collapse('#CollapsePato-CR', true)">
              <label for="pato-CR">Si</label>
            </div>
            <div class="col-3">
              <input type="radio"  id="pato-CR" name="Pato-CR" value="0" required onclick="collapse('#CollapsePato-CR', false)">
              <label for="pato-CR" >No</label>
            </div>
            <div class="collapse" id="CollapsePato-CR">
              <textarea name="name" class="form-control input-form" rows="2" cols="2" placeholder="Comentario..."></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="accordion-item bg-acordion">
      <h2 class="accordion-header" id="collappNoPatologicos">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNoPatologicosTarget" aria-expanded="false" aria-controls="accordionEstudios">
          <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Antecedentes patológicos
        </button>
      </h2>
      <div id="collapseNoPatologicosTarget" class="accordion-collapse collapse" aria-labelledby="collappNoPatologicos">
        <div class="accordion-body">
        </div>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  function collapse(collapID, valor){
    if (valor == true) {
      $(collapID).collapse("show")
    }else{
      $(collapID).collapse("hide")
      $(collapID).find(':input').val('')
    }
  }
</script>
