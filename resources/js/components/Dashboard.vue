<template>
  <div v-if="isUserGood" id="Dashboard">
    <div class="row justify-content-center">
      <div class="col-auto">
        <button class="btn btn-outline-info px-5 py-1">
          <h5
            @click="isUsers = !isUsers"
            class="title m-0"
          >{{ (!isUsers) ? 'Show Users ' : 'Show Info ' }}</h5>
        </button>
        <button @click="logout" class="btn btn-outline-danger px-5 py-1">
          <h5 class="title m-0">Sign out</h5>
        </button>
      </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h1 class="title">Add User</h1>
            <div v-if="!userRegistrationDone">
              <div class="form-group">
                <input type="text" v-model="form.name" class="form-control" placeholder="User Name" />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  v-model="form.email"
                  class="form-control"
                  placeholder="User Email"
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  v-model="form.password"
                  class="form-control"
                  placeholder="User Password"
                />
              </div>
            </div>
            <div v-if="userRegistrationDone">
              <h3 class="title text-danger">User has been created</h3>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" @click="registration" class="btn btn-primary">Add User</button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="isUsers" class="row justify-content-center">
      <div class="col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row justify-content-between">
              <div class="col-auto">
                <h3 class="panel-title">Users</h3>
              </div>
              <div class="col-auto">
                <button
                  type="button"
                  class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#exampleModal"
                >Add User</button>
              </div>
            </div>

            <div class="pull-right">
              <span
                class="clickable filter"
                data-toggle="tooltip"
                title="Toggle table filter"
                data-container="body"
              >
                <i class="glyphicon glyphicon-filter"></i>
              </span>
            </div>
          </div>
          <div class="panel-body">
            <input
              type="text"
              class="form-control"
              id="dev-table-filter"
              data-action="filter"
              data-filters="#dev-table"
              placeholder="Filter Developers"
            />
          </div>
          <table class="table table-hover" id="dev-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.show_password }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div v-if="!isUsers" class="row justify-content-center">
      <div class="col-md-10">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Forms Details</h3>
          </div>
          <div class="panel-body">
            <input
              type="text"
              class="form-control"
              id="dev-table-filter"
              data-action="filter"
              data-filters="#dev-table"
              placeholder="Filter Developers"
            />
          </div>
          <a
            href="http://127.0.0.1:8000/api/v1/forms_excel"
            target="_blank"
            class="btn btn-primary"
            rel="noopener noreferrer"
          >Export To Excel</a>
          <!-- Modal -->

          <div
            class="modal fade bd-example-modal-lg"
            id="exampleModal1"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel1"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Full Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <ul class="list-group" v-if="item != ''">
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Site Ref</div>
                        <div class="col-md-auto">{{ item['formDetails'].site_ref }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Site Type</div>
                        <div class="col-md-auto">{{ item['formDetails'].site_type }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Date and Time</div>
                        <div class="col-md-auto">{{ item['formDetails'].date_and_time}}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Cluster Engineer</div>
                        <div class="col-md-auto">{{ item['formDetails'].cluster_enginner }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Checkman</div>
                        <div class="col-md-auto">{{ item['formDetails'].check_man }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Site With Single Gen</div>
                        <div
                          class="col-md-auto"
                        >{{ item['formDetails'].site_with_single_generator }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">S/N Gen1</div>
                        <div class="col-md-auto">{{ item['formDetails'].s_n_generator1 }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">S/N Gen2</div>
                        <div class="col-md-auto">{{ item['formDetails'].s_n_generator2 }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Type</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen1_type }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Size</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen1_size }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Type</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen2_type }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Size</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen2_size }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Status</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen1_status }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Status</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen2_status }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 R.Hours</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen1_rhours }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 R.Hours</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen2_rhours }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Oil</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_oil }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Oil Hours</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen1_oil_hours }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Oil</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_oil }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Oil Hours</div>
                        <div class="col-md-auto">{{ item['formDetails'].gen2_oil_hours }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Oil Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_oil_filter }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Oil Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_oil_filter }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Fuel Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_oil_filter }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Fuel Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_oil_filter }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Lift Pump Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_lift_pump_filter }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Lift Pump Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_lift_pump_filter }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Air Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_air_filter }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Air Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_air_filter }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Clean</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_clean }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Clean</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_clean }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Radiator Clean</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_radiator_clean }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Radiator Clean</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_radiator_clean }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Sensors Status</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_sensor_status }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Sensors Status</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_sensor_status }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen1 Charging Issue</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen1_charging_issue }}</div>
                      </div>
                    </li>

                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Gen2 Charging Issue</div>
                        <div class="col-md-auto">{{ item['formBooleans'].gen2_charging_issue }}</div>
                      </div>
                    </li>


                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Engine Smoke Ok</div>
                        <div class="col-md-auto">{{ item['formBooleans'].engine_smoke_ok }}</div>
                      </div>
                    </li>

                                      <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Engine Smoke White</div>
                        <div class="col-md-auto">{{ item['formBooleans'].engine_smoke_white }}</div>
                      </div>
                    </li>

                  <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Engine Smoke Blac;</div>
                        <div class="col-md-auto">{{ item['formBooleans'].engine_smoke_black }}</div>
                      </div>
                    </li>

                                      <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Oil Leakage Ok</div>
                        <div class="col-md-auto">{{ item['formBooleans'].oil_leakage_ok }}</div>
                      </div>
                    </li>

                                      <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Oil Leakage Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].oil_filter }}</div>
                      </div>
                    </li>
                                  <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Oil Leakage Case</div>
                        <div class="col-md-auto">{{ item['formBooleans'].oil_case }}</div>
                      </div>
                    </li>

                                   <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Oil Leakage Pump</div>
                        <div class="col-md-auto">{{ item['formBooleans'].oil_pump }}</div>
                      </div>
                    </li>

                                   <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Oil Leakage drain</div>
                        <div class="col-md-auto">{{ item['formBooleans'].oil_drain }}</div>
                      </div>
                    </li>
                                   <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Oil Valve Cover</div>
                        <div class="col-md-auto">{{ item['formBooleans'].oil_valve_cover }}</div>
                      </div>
                    </li>

                                                       <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Oil Leakage Seal</div>
                        <div class="col-md-auto">{{ item['formBooleans'].oil_seal }}</div>
                      </div>
                    </li>
                                                    <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Water Leakage Ok</div>
                        <div class="col-md-auto">{{ item['formBooleans'].water_leakage_ok }}</div>
                      </div>
                    </li>
                    
                                                 <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Water Leakage Radiator</div>
                        <div class="col-md-auto">{{ item['formBooleans'].water_leakage_radiator }}</div>
                      </div>
                    </li>
                                       <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Water Leakage Fils</div>
                        <div class="col-md-auto">{{ item['formBooleans'].water_leakage_fils }}</div>
                      </div>
                    </li>
                    
                                                           <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Water Leakage Radiator Join</div>
                        <div class="col-md-auto">{{ item['formBooleans'].water_radiator_join }}</div>
                      </div>
                    </li>

                                       <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Water Leakage Pump</div>
                        <div class="col-md-auto">{{ item['formBooleans'].water_pump }}</div>
                      </div>
                    </li>

                                  <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Leakage Ok</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_leakage_ok }}</div>
                      </div>
                    </li>


                                  <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Leakage Nozzle</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_nozzle }}</div>
                      </div>
                    </li>


                                  <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Leakage Pipe Valve</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_pipe_valve }}</div>
                      </div>
                    </li>

                                  <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Leakage Tube</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_tube }}</div>
                      </div>
                    </li>

                             <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Leakage Filter</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_filter }}</div>
                      </div>
                    </li>

                             <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Tank CM</div>
                        <div class="col-md-auto">{{ item['formDetails'].fuel_tank_cm }}</div>
                      </div>
                    </li>

                                                 <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Tank Piping</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_tank_piping }}</div>
                      </div>
                    </li>

                                            <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Tank Pipe Valves</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_tank_pipe_valves }}</div>
                      </div>
                    </li>

                                                                <li class="list-group-item">
                      <div class="row mt-0 justify-content-around">
                        <div class="col-md-auto">Fuel Tank Drain</div>
                        <div class="col-md-auto">{{ item['formBooleans'].fuel_tank_drain }}</div>
                      </div>
                    </li>




                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-hover" id="dev-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Site Ref</th>
                <th>Site Type</th>
                <th>Date And Time</th>
                <th>Cluster Engineer</th>
                <th>Checkman</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in data" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ item['formDetails'].site_ref }}</td>
                <td>{{ item['formDetails'].site_type }}</td>
                <td>{{ item['formDetails'].date_and_time }}</td>
                <td>{{ item['formDetails'].cluster_enginner }}</td>
                <td>{{ item['formDetails'].check_man }}</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#exampleModal1"
                    @click="showSingle(item)"
                  >Show more</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
let config = {
  headers: {
    Authorization: `Bearer ${window.localStorage.getItem("token")}`
  }
};
export default {
  data() {
    return {
      users: [],
      isUsers: true,
      data: [],
      isUserGood: false,
      form: {
        name: "",
        email: "",
        password: "",
        phone: ""
      },
      userRegistrationDone: false,
      item: ""
    };
  },
  async created() {
    await this.checkUser();
    await this.getUsers();
    await this.getFields();
  },
  methods: {
    checkUser() {
      if (!window.localStorage.getItem("token"))
        return (window.location.href = "http://127.0.0.1:8000/");
      axios.get("http://127.0.0.1:8000/api/v1/user", config).then(res => {
        if (res.data["is_admin"] == 1) this.isUserGood = true;
      });
    },
    showSingle(item) {
      this.item = item;
    },
    logout() {
      window.localStorage.removeItem("token");
      window.location.href = "http://127.0.0.1:8000/";
    },
    getUsers() {
      axios
        .get("http://127.0.0.1:8000/api/v1/users", config)
        .then(res => (this.users = res.data["data"]));
    },
    async getFields() {
      let result = await axios.get(
        "http://127.0.0.1:8000/api/v1/forms_details",
        config
      );
      this.data = result["data"].data;
    },
    registration() {
      axios
        .post("http://127.0.0.1:8000/api/v1/registration", this.form, config)
        .then(res => {
          if (res.data["success"]) this.userRegistrationDone = true;
        });
    }
  }
};
</script>

<style>
.row {
  margin-top: 40px;
  padding: 0 10px;
}
.clickable {
  cursor: pointer;
}

.panel-heading div {
  margin-top: -18px;
  font-size: 15px;
}
.panel-heading div span {
  margin-left: 5px;
}
.panel-body {
  display: none;
}
</style>
