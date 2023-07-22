<template>
    <!-- resources/assets/js/components -->
    <div>
      <canvas ref="canvas"></canvas>
    </div>
  </template>

  <script>
  import { ref, onMounted } from 'vue'; // Import Vue 3 Composition API
  import * as Chart from 'chart.js'; // Import the entire Chart.js module

  export default {
    props: {
      labels: String,
      dataProp: String,
    },
    setup(props) {
      const canvasRef = ref(null);

      onMounted(() => {
        const ctx = canvasRef.value.getContext('2d');
        new Chart.Chart(ctx, { // Access the Chart object directly from the imported module
          type: 'bar',
          data: {
            labels: JSON.parse(props.labels),
            datasets: [
              {
                label: 'Safety Observation Form',
                data: JSON.parse(props.dataProp),
                backgroundColor: [
                  '#2ecc71',
                  '#e74c3c',
                  '#8e44ad',
                  '#d35400',
                  '#16a085',
                ],
              },
            ],
          },
          options: {
            title: {
              display: true,
              fontSize: 22,
              text: 'Example',
            },
          },
        });
      });

      return {
        canvasRef,
      };
    },
  };
  </script>
