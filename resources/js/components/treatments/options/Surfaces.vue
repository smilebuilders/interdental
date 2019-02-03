<template>
<div class="form-group" id="surface">
    <select value id="surfaces" multiple="multiple" name="surfaces" style="display: none;">
    <option value="1">Mesial</option>
    <option value="2">Distal</option>
    <option value="4">Buccal</option>
    <option value="5">Lingual</option>
    <option value="7">Occlusal</option>
  </select>

  <div class="btn-group open" style="width:100%;">
    <button class="multiselect dropdown-toggle btn btn-default btn-block" data-toggle="dropdown" title="- Superficies -">
      <span class="multiselect-selected-text">- Superficies -</span>
      <b class="caret"></b>
    </button>

    <ul class="multiselect-container dropdown-menu">
      <li class>
        <a tabindex="0">
          <label class="checkbox">
            <input type="checkbox" value="Mesial" v-model="checkedSurfaces"> Mesial
          </label>
        </a>
      </li>
      <li>
        <a tabindex="0">
          <label class="checkbox">
            <input type="checkbox" value="Distal" v-model="checkedSurfaces"> Distal
          </label>
        </a>
      </li>
      <li>
        <a tabindex="0">
          <label class="checkbox">
            <input type="checkbox" value="Buccal" v-model="checkedSurfaces"> Buccal
          </label>
        </a>
      </li>
      <li>
        <a tabindex="0">
          <label class="checkbox">
            <input type="checkbox" value="Lingual" v-model="checkedSurfaces"> Lingual
          </label>
        </a>
      </li>
      <li>
        <a tabindex="0">
          <label class="checkbox">
            <input type="checkbox" value="Occlusal" v-model="checkedSurfaces"> Occlusal
          </label>
        </a>
      </li>
    </ul>
  </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            checkedSurfaces: []
        }
    },
    methods: {
        
    }
}
</script>
