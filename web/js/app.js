new Vue({
    delimiters: ['${', '}'],
    el: 'main',
    data () {
        return {
            asesors: [],
            careers: [],
            newAsesor: false,
            robot: null,
            team: null,
            selectedAsesor: 0,
            asesor: {
                name: null,
                firstLastName: null,
                secondLastName: null,
                email: null
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
          let asesor, captain, firstAlumn, secondAlumn = null;

          if ((this.selectedAsesor === 0) && (this.asesor.name !== '' || this.asesor.name !== null) && (this.asesor.firstLastName !== '' || this.asesor.firstLastName !== null) && (this.asesor.email !== '' || this.asesor.email !== null)) {
              asesor = {
                  name: this.asesor.name,
                  firstLastName: this.asesor.firstLastName,
                  secondLastName: this.asesor.secondLastName,
                  email: this.asesor.email
              };
          } else if (this.selectedAsesor > 0){
              asesor = this.selectedAsesor;
          }

          if ((this.captain.noControl !== '' || this.captain.noControl !== null) && (this.captain.name !== '' || this.captain.name !== null) && (this.captain.firstLastName !== '' || this.captain.firstLastName !== null) && (this.captain.email !== '' || this.captain.email !== null) && (this.captain.selectedCareer > 0) && (parseInt(this.captain.semester) > 0)) {
              captain = {
                  noControl: this.captain.noControl,
                  name: this.captain.name,
                  firstLastName: this.captain.firstLastName,
                  secondLastName: this.captain.secondLastName,
                  email: this.captain.email,
                  selectedCareer: this.captain.selectedCareer,
                  semester: parseInt(this.captain.semester)
              }
          }

          if ((this.firstAlumn.noControl !== '' || this.firstAlumn.noControl !== null) && (this.firstAlumn.name !== '' || this.firstAlumn.name !== null) && (this.firstAlumn.firstLastName !== '' || this.firstAlumn.firstLastName !== null) && (this.firstAlumn.email !== '' || this.firstAlumn.email !== null) && (this.firstAlumn.selectedCareer > 0) && (parseInt(this.firstAlumn.semester) > 0)) {
              firstAlumn = {
                  noControl: this.firstAlumn.noControl,
                  name: this.firstAlumn.name,
                  firstLastName: this.firstAlumn.firstLastName,
                  secondLastName: this.firstAlumn.secondLastName,
                  email: this.firstAlumn.email,
                  selectedCareer: this.firstAlumn.selectedCareer,
                  semester: parseInt(this.firstAlumn.semester)
              }
          }

          if ((this.secondAlumn.noControl !== '' || this.secondAlumn.noControl !== null) && (this.secondAlumn.name !== '' || this.secondAlumn.name !== null) && (this.secondAlumn.firstLastName !== '' || this.secondAlumn.firstLastName !== null) && (this.secondAlumn.email !== '' || this.secondAlumn.email !== null) && (this.secondAlumn.selectedCareer > 0) && (parseInt(this.secondAlumn.semester) > 0)) {
              secondAlumn = {
                  noControl: this.secondAlumn.noControl,
                  name: this.secondAlumn.name,
                  firstLastName: this.secondAlumn.firstLastName,
                  secondLastName: this.secondAlumn.secondLastName,
                  email: this.secondAlumn.email,
                  selectedCareer: this.secondAlumn.selectedCareer,
                  semester: parseInt(this.secondAlumn.semester)
              }
          }

          let teamData = {
              team: this.team,
              robot: this.robot,
              asesor,
              captain,
              firstAlumn,
              secondAlumn
          };
          
          axios.post('/api/registro/equipo/nuevo', teamData)
              .then(function (response) {
                  console.log(response)
              })
              .catch(function (error) {
                  console.log(error);
              });
          // Clean form
          this.clearForm();
          if(this.newAsesor) {
              this.fetchAsesors();
              this.newAsesor = false;
          }
      },
      selectAddNewAsesor () {
        this.newAsesor = true;
        this.selectedAsesor = 0;
      },
      unSelectAddNewAsesor () {
        this.newAsesor = false;
        this.selectedAsesor = 0;
      },
      clearForm () {
        this.team = '';
        this.robot = '';
        this.selectedAsesor = 0;
        this.asesor.name = null;
        this.asesor.firstLastName = null;
        this.asesor.secondLastName = null;
        this.asesor.email = null;
        this.captain.noControl = '';
        this.captain.name = '';
        this.captain.firstLastName = '';
        this.captain.secondLastName = '';
        this.captain.email = '';
        this.captain.selectedCareer = 0;
        this.captain.semester = 0;
        this.firstAlumn.noControl = '';
        this.firstAlumn.name = '';
        this.firstAlumn.firstLastName = '';
        this.firstAlumn.secondLastName = '';
        this.firstAlumn.email = '';
        this.firstAlumn.selectedCareer = 0;
        this.firstAlumn.semester = 0;
        this.secondAlumn.noControl = '';
        this.secondAlumn.name = '';
        this.secondAlumn.firstLastName = '';
        this.secondAlumn.secondLastName = '';
        this.secondAlumn.email = '';
        this.secondAlumn.selectedCareer = 0;
        this.secondAlumn.semester = 0;
      }
    }
});