<template>
  <div
    class="modal fade"
    :id="'updateCarModal' + ID"
    :class="'updateCarModal' + ID"
    tabindex="-1"
    :aria-labelledby="'updateCarModalLabel' + ID"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" :id="'updateCarModalLabel' + ID">
            Update Car
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form
          method="POST"
          @submit.prevent="UpdateCarDetails"
          id="formUpdateCarModal"
          enctype="multipart/form-data"
        >
          <div class="modal-body">
            <div class="mb-3">
              <div
                class="alert alert-success"
                role="alert"
                v-text="resultSuccessMsg"
                v-if="resultSuccess"
              ></div>
              <div
                class="alert alert-danger"
                role="alert"
                v-text="resultErrMsg"
                v-if="resultErr"
              ></div>
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control" id="ID" :value="ID" />
            </div>
            <div class="form-group mb-2">
              <input type="text" class="form-control" id="name" :value="Name" />
            </div>
            <div class="form-group mb-2">
              <input
                type="text"
                class="form-control"
                id="price"
                :value="Price"
              />
            </div>
            <div class="form-group mb-2">
              <textarea
                type="text"
                class="form-control"
                id="description"
                v-text="Description"
              ></textarea>
            </div>
            <div class="form-group mb-2">
              <input
                type="text"
                class="form-control"
                id="modelYear"
                :value="ModelYear"
              />
            </div>
            <div class="form-group mb-2">
              <input
                type="file"
                class="form-control"
                id="imageCar"
                ref="imageCar"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Fermer
            </button>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "UpdateCarDetails",
  props: ["ID", "Name", "Price", "ModelYear", "Description", "Image"],
  data() {
    return {
      resultErr: false,
      resultErrMsg: "",
      resultSuccess: false,
      resultSuccessMsg: "",
      carImage: "",
    };
  },
  methods: {
    async UpdateCarDetails() {
      let formData = new FormData();
      formData.append("id", this.ID);
      formData.append("name", this.Name);
      formData.append("price", this.Price);
      formData.append("modelYear", this.ModelYear);
      formData.append("description", this.Description);
      formData.append("imageCar", this.carImage);
      alert(this.carImage);
      // 333967_2019_Mercedes-Benz_G-Class.jpg
      let result = await axios.post(
        "http://sniper/javascript/my-car-vuejs/src/api/cars.php?do=updateCar",
        formData
      );
      let resultData = result.data;
      // alert(resultData);
      if (resultData.error) {
        this.resultErr = true;
        this.resultErrMsg = resultData.message;
        this.resultSuccess = false;
        this.resultSuccessMsg = "";
      } else {
        this.resultErr = false;
        this.resultErrMsg = "";
        this.resultSuccess = true;
        this.resultSuccessMsg = resultData.message;
        setTimeout(() => {
          this.hideCurrentModal("updateCarModal" + this.ID);
        }, 1000);
      }
    },
    hideCurrentModal(id) {
      document.getElementsByTagName("body")[0].removeAttribute("class");
      document.getElementsByTagName("body")[0].removeAttribute("style");

      const elements = document.getElementsByClassName("modal-backdrop");
      while (elements.length > 0) elements[0].remove();

      const currentModal = document.getElementsByClassName(id);
      while (currentModal.length > 0) currentModal[0].remove();
    },
  },
};
</script>
