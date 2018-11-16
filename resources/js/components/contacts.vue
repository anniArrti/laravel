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
        <div class="row">
          <table class="table table-hover table-bordered" id="app">
            <thead>
              <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email ID</th>
                  <th>Message</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for='(item, index) in items'>
                <td>{{ index+1 }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.message }}</td>
                <td>
                    <router-link :to="{name: 'edit', params: {id: item.id}}" class="btn btn-xs btn-default">
                        Edit
                    </router-link>
                    <a href="#"
                       class="btn btn-xs btn-danger"
                       v-on:click="deleteEntry(item.id, index)">
                        Delete
                    </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
   <!--   -->
</template>

<script>
export default {
  data() {
    return {
      items: [],
      fields: {},
      errors: {},
      success: false,
      loaded: true,
    }
  },
  mounted: function mounted() {
    this.getVueItems();
  },
  methods: {
    submit() {
      if (this.loaded) {
        this.loaded = false;
        this.success = false;
        this.errors = {};
        var _this = this;
        axios.post('/companies', this.fields).then(response => {
          this.fields = {}; //Clear input fields.
          this.loaded = true;
          this.success = true;
          _this.getVueItems();
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
      }
    },
    getVueItems: function getVueItems() {
      var _this = this;
     
      axios.get('/companies').then(function (response) {
        _this.items = response.data;

      });
    },
     deleteEntry(id, index) {
        if (confirm("Do you really want to delete it?")) {
            var app = this;
            axios.delete('/companies/' + id)
                .then(function (resp) {
                    app.items.splice(index, 1);
                })
                .catch(function (resp) {
                    alert("Could not delete company");
                });
        }
    },
  },
}
</script>