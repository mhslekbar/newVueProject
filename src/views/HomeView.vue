<template>
  <div class="container">
    <h1 class="text-center">Car Shop</h1>
    <p>fullName from Data : {{ fullName }}</p>
    <p>fullName from State : {{ $store.state.fullName }}</p>
    <p>fullName is : {{ fullNameIs }}</p>

    <div>
      <button @click="addNewCar()" class="btn btn-success float-end mb-2">
        Add New Car
      </button>
      <div class="clearfix"></div>
    </div>

    <div v-if="emptyCar">
      <div role="alert" class="alert alert-warning" v-text="emptyCar"></div>
    </div>
    <div v-else>
      <div class="row justify-content-between">
        <div
          class="col-sm-6 col-lg-4 each-car"
          v-for="(car, i) in dataOfCars"
          :key="i"
        >
          <img
            :src="require(`@/assets/cars_image/${car.Image}`)"
            class="mx-auto d-block rounded img-fluid"
            :alt="car.Name"
            v-if="car.Image"
          />
          <h4 class="text-center">{{ car.Name }} {{ car.ModelYear }}</h4>

          <div>
            <div class="float-start">
              <button
                class="btn btn-outline-success"
                v-text="convertNumToPrice(car.Price)"
              ></button>
            </div>
            <div class="float-end">
              <button
                class="btn btn-outline-primary"
                type="button"
                data-bs-toggle="modal"
                :data-bs-target="'#ShowCarDetails' + car.ID"
              >
                More Details
              </button>
              <ShowCarDetails
                :carData="dataOfCars"
                :ID="car.ID"
                :Name="car.Name"
                :Description="car.Description"
                :Price="car.Price"
                :ModelYear="car.ModelYear"
                :Image="car.Image"
              />
            </div>
          </div>

          <div class="mt-5">
            <div class="float-start">
              <button
                class="btn btn-danger"
                type="button"
                data-bs-toggle="modal"
                :data-bs-target="'#deleteCarModal' + car.ID"
              >
                Delete
              </button>
              <DeleteCarDetails :ID="car.ID" @updateCars="currentCar($event)" />
            </div>
            <div class="float-end">
              <button
                class="btn btn-success"
                type="button"
                data-bs-toggle="modal"
                :data-bs-target="'#updateCarModal' + car.ID"
              >
                Update
              </button>
              <UpdateCarDetails
                :ID="car.ID"
                :Name="car.Name"
                :Price="car.Price"
                :ModelYear="car.ModelYear"
                :Description="car.Description"
                :Image="car.Image"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ShowCarDetails from "@/components/Cars/ShowCarDetails.vue";
import UpdateCarDetails from "@/components/Cars/UpdateCarDetails.vue";
import DeleteCarDetails from "@/components/Cars/DeleteCarDetails.vue";
import axios from "axios";

export default {
  name: "HomeView",
  components: {
    ShowCarDetails,
    UpdateCarDetails,
    DeleteCarDetails,
  },
  computed: {
    fullNameIs() {
      return this.$store.state.fullName;
    },
  },
  data() {
    return {
      is_db_connection: "",
      db_connection_msg: "",
      dataOfCars: [],
      emptyCar: "",
      fullName: this.$store.state.fullName,
    };
  },
  mounted() {
    // setInterval(() => {
    this.getAllCars();
    // }, 1000);
  },
  methods: {
    convertNumToPrice(num) {
      return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "MRU",
      }).format(num);
    },
    addNewCar() {
      this.$router.push({ name: "AddNewCar" });
    },
    async getAllCars() {
      let res = await axios.get(
        "http://sniper/javascript/my-car-vuejs/src/api/cars.php?do=read"
      );
      const resData = res.data;
      if (resData.error) {
        this.emptyCar = resData.message;
      } else {
        this.dataOfCars = resData.Cars;
      }
    },
    currentCar(car) {
      this.dataOfCars = car;
      this.getAllCars();
    },
  },
};
</script>

<style scoped>
.each-car {
  padding: 10px;
  margin-bottom: 10px;
  border: 10px solid #eee;
}
.each-car img {
  width: 320px;
  height: 215px;
  margin-bottom: 10px;
}
</style>
