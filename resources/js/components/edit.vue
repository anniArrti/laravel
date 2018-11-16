<template>
 <div class="container">
        <div class="row">
          <div class="col-md-2 col-md-offset-2"></div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                       <form @submit.prevent="submit">
                          <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" name="name" id="name" v-model="fields.name" />
                              <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                          </div>
                    
                          <div class="form-group">
                              <label for="email">E-mail</label>
                              <input type="email" class="form-control" name="email" id="email" v-model="fields.email" />
                              <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                          </div>
                    
                          <div class="form-group">
                              <label for="message">Message</label>
                              <textarea class="form-control" id="message" name="message" rows="5" v-model="fields.message"></textarea>
                              <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
                          </div>

                          <button type="submit" class="btn btn-primary">Send message</button>

                          <div v-if="success" class="alert alert-success mt-3">
                              Message sent!
                          </div>
                      </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2"></div>
        </div>
  </div>
</template>
<script>
export default {
  mounted() {
      let app = this;
      let id = app.$route.params.id;
      app.companyId = id;
      axios.get('/companies/' + id)
          .then(function (resp) {
            console.log(resp);
              app.fields = resp.data;
          })
          .catch(function () {
              alert("Could not load your company")
          });
  },
  data() {
    return {
      companyId: null,
      items: [],
      fields: {},
      errors: {},
      success: false,
      loaded: true,
    }
  },
  methods: {
    submit() {
      var app = this;
      if (this.loaded) {
        this.loaded = false;
        this.success = false;
        this.errors = {};
        
        axios.patch('/companies/'+ app.companyId, this.fields).then(response => {
          this.fields = {}; //Clear input fields.
          this.loaded = true;
          this.success = true;
          app.$router.push({path: '/contacts'});
          //_this.getVueItems();
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
      }
    },
    /*getVueItems: function getVueItems() {
      var _this = this;
     
      axios.get('/vueitems').then(function (response) {
        console.log(response);
        _this.items = response.data.users;
        console.log(_this.items);
      });
    },*/
  },
}
</script>  