// resources/js/components/AutoCompleteInputOperationName.vue
<template>
  <div>
    <label for="operation_name">Nama Operasi</label>
    <input
      type="text"
      name="operation_name"
      id="operation_name"
      class="form-control"
      v-model="inputValue"
      @input="handleInput"
      required
    />
    <ul v-if="showSuggestions" class="autocomplete-suggestions">
      <li v-for="suggestion in suggestions" :key="suggestion" @click="selectSuggestion(suggestion)">
        {{ suggestion }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputValue: "",
      suggestions: [],
      showSuggestions: false,
    };
  },
  methods: {
    handleInput() {
      if (this.inputValue.length >= 3) {
        // Panggil fungsi untuk mendapatkan rekomendasi nama operasi dari server (misalnya lewat AJAX)
        this.getOperationNameSuggestions();
      } else {
        this.suggestions = [];
        this.showSuggestions = false;
      }
    },
    getOperationNameSuggestions() {
      // Lakukan permintaan ke server (misalnya menggunakan axios) untuk mendapatkan rekomendasi nama operasi berdasarkan nilai input yang ada
      axios
        .get(`/api/operation-names?q=${this.inputValue}`)
        .then((response) => {
          this.suggestions = response.data;
          this.showSuggestions = true;
        })
        .catch((error) => {
          console.error(error);
          this.suggestions = [];
          this.showSuggestions = false;
        });
    },
    selectSuggestion(suggestion) {
      this.inputValue = suggestion;
      this.showSuggestions = false;
    },
  },
};
</script>
