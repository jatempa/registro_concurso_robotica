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
                noControl: '',
                name: '',
                firstLastName: '',
                secondLastName: '',
                email: '',
                selectedCareer: 0,
                semester: 0
            },
            firstAlumn: {
                noControl: '',
                name: '',
                firstLastName: '',
                secondLastName: '',
                email: '',
                selectedCareer: 0,
                semester: 0
            },
            secondAlumn: {
                noControl: '',
                name: '',
                firstLastName: '',
                secondLastName: '',
                email: '',
                selectedCareer: 0,
                semester: 0
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

          let teamData = {
              team: this.team,
              robot: this.robot,
              asesor: this.selectedAsesor,
              captain: {
                  noControl: this.captain.noControl,
                  name: this.captain.name,
                  firstLastName: this.captain.firstLastName,
                  secondLastName: this.captain.secondLastName,
                  email: this.captain.email,
                  selectedCareer: this.captain.selectedCareer,
                  semester: parseInt(this.captain.semester)
              },
              firstAlumn: {
                  noControl: this.firstAlumn.noControl,
                  name: this.firstAlumn.name,
                  firstLastName: this.firstAlumn.firstLastName,
                  secondLastName: this.firstAlumn.secondLastName,
                  email: this.firstAlumn.email,
                  selectedCareer: this.firstAlumn.selectedCareer,
                  semester: parseInt(this.firstAlumn.semester)
              },
              secondAlumn: {
                  noControl: this.secondAlumn.noControl,
                  name: this.secondAlumn.name,
                  firstLastName: this.secondAlumn.firstLastName,
                  secondLastName: this.secondAlumn.secondLastName,
                  email: this.secondAlumn.email,
                  selectedCareer: this.secondAlumn.selectedCareer,
                  semester: parseInt(this.secondAlumn.semester)
              }
          };

          axios.post('/api/registro/equipo/nuevo', teamData)
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