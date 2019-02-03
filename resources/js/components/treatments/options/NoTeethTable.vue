<template>
  <div class="form-group" v-on:display="displayTable()">
    <button id="visibleTeeth" name="visibleTeeth" class="btn btn-default btn-block" v-on:click="displayTable">- Diente Faltante -</button>
    <table id="noteeth" class="table-sm table-bordered" style="display: none;">
      <tbody>
        <tr>
          <th colspan="16" class="border-right">Selecciona el diente</th>
        </tr>
        <tr v-on:click="select">
          <td class="molar secondary maxilar">1</td>
          <td class="molar secondary maxilar">2</td>
          <td class="molar secondary maxilar">3</td>
          <td class="pre-molar secondary maxilar">4</td>
          <td class="pre-molar secondary maxilar">5</td>
          <td class="canine secondary maxilar">6</td>
          <td class="incisor secondary maxilar">7</td>
          <td class="incisor secondary maxilar">8</td>
          <td class="incisor secondary maxilar">9</td>
          <td class="incisor secondary maxilar">10</td>
          <td class="canine secondary maxilar">11</td>
          <td class="pre-molar secondary maxilar">12</td>
          <td class="pre-molar secondary maxilar">13</td>
          <td class="molar secondary maxilar">14</td>
          <td class="molar secondary maxilar">15</td>
          <td class="molar secondary maxilar">16</td>
        </tr>
        <tr v-on:click="select">
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
          <td class="molar primary">A</td>
          <td class="molar primary">B</td>
          <td class="canine primary">C</td>
          <td class="incisor primary">D</td>
          <td class="incisor primary">E</td>
          <td class="incisor primary">F</td>
          <td class="incisor primary">G</td>
          <td class="canine primary">H</td>
          <td class="molar primary">I</td>
          <td class="molar primary">J</td>
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
        </tr>
        <tr v-on:click="select">
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
          <td class="molar primary">T</td>
          <td class="molar primary">S</td>
          <td class="canine primary">R</td>
          <td class="incisor primary">Q</td>
          <td class="incisor primary">P</td>
          <td class="incisor primary">O</td>
          <td class="incisor primary">N</td>
          <td class="canine primary">M</td>
          <td class="molar primary">L</td>
          <td class="molar primary">K</td>
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
          <td class="cell-disabled"></td>
        </tr>
        <tr v-on:click="select">
          <td class="molar secondary mandibular">32</td>
          <td class="molar secondary mandibular">31</td>
          <td class="molar secondary mandibular">30</td>
          <td class="pre-molar secondary mandibular">29</td>
          <td class="pre-molar secondary mandibular">28</td>
          <td class="canine secondary mandibular">27</td>
          <td class="incisor secondary mandibular">26</td>
          <td class="incisor secondary mandibular">25</td>
          <td class="incisor secondary mandibular">24</td>
          <td class="incisor secondary mandibular">23</td>
          <td class="canine secondary mandibular">22</td>
          <td class="pre-molar secondary mandibular">21</td>
          <td class="pre-molar secondary mandibular">20</td>
          <td class="molar secondary mandibular">19</td>
          <td class="molar secondary mandibular">18</td>
          <td class="molar secondary mandibular">17</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
    props: ['options'],
    data() {
        return {
            selected: ''
        }
    },
    mounted: function() {    

    },
    methods: {
        select(event) {
            this.selected = event.target
            

            if(this.selected.classList.contains('selected')) {
                this.selected.classList.remove('selected')
            } else {

                if(this.selected.classList.contains('cell-disabled')) {
                    
                } else {
                    this.selected.className += " selected"
                }
            }

        },
        displayTable(event) {
            $('#noteeth').toggle();
            
            if(this.options.includes('noincisor')) {
                $(".incisor").addClass( "cell-disabled" );
            }
            if(this.options.includes('nocanine')) {
                $(".canine").addClass( "cell-disabled" );
            }
            if(this.options.includes('nomolar')) {
                $(".molar").addClass( "cell-disabled" );
            }
            if(this.options.includes('nopremolar')) {
                $(".pre-molar").addClass( "cell-disabled" );
            }
            if(this.options.includes('noprimary')) {
                $(".primary").addClass( "cell-disabled" );
            }
            if(this.options.includes('nosecondary')) {
                $(".secondary").addClass( "cell-disabled" );
            }
            if(this.options.includes('nomandibular')) {
                $(".mandibular").addClass( "cell-disabled" );
            }
            if(this.options.includes('nomaxilar')) {
                $(".maxilar").addClass( "cell-disabled" );
            }
        }
    }
}
</script>
