new Vue({
    delimiters: ['${', '}'],
    el: 'main',
    data () {
        return {
            asesors: [],
            careers: [],
            newAsesor: false,
            robot: '',
            team: '',
            selectedAsesor: 0,
            asesor: {
                name: '',
                firstLastName: '',
                secondLastName: '',
                email: ''
            },
            captain: {
                name: '',
                firstLastName: '',
                secondLastName: '',
                email: '',
                selectedCareer: 0
            },
            firstAlumn: {
                name: '',
                firstLastName: '',
                secondLastName: '',
                email: '',
                selectedCareer: 0
            },
            secondAlumn: {
                name: '',
                firstLastName: '',
                secondLastName: '',
                email: '',
                selectedCareer: 0
            }
        }
    },
    mounted () {
        this.fetchAsesors(),
        this.fetchCareers()
    },
    methods: {
      fetchAsesors () {
        axios.get('/api/asesors')
             .then(response => {
                this.asesors = response.data.asesores
             }
        )
      },
      fetchCareers () {
        axios.get('/api/careers')
             .then(response => {
                this.careers = response.data.carreras
             }
        )
      },
      createTeam () {
          axios.defaults.headers.common = {
              'X-Requested-With': 'XMLHttpRequest',
          };

          axios.post('/api/registro/equipo/nuevo', { 'carrera': 3 })
              .then(function (response) {
                  console.log(response);
              })
              .catch(function (error) {
                  console.log(error);
              });
      },
      selectAsesor () {
        this.newAsesor = false
      }
    }
});