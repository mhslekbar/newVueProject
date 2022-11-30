<template>
  <div
    class="modal fade"
    :id="'deleteCarModal' + ID"
    :class="'deleteCarModal' + ID"
    tabindex="-1"
    :aria-labelledby="'deleteCarModalLabel' + ID"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" :id="'deleteCarModalLabel' + ID">
            Delete Car
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
          @submit.prevent="deleteCarDetails"
          id="formDeleteCarModal"
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
              <input
                type="hidden"
                class="form-control"
                name="ID"
                id="ID"
                :value="ID"
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
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery';
import axios from "axios";

export default {
  name: "DeleteCarDetails",
  props: ["ID"],
  data() {
    return {
      resultErr: false,
      resultErrMsg: "",
      resultSuccess: false,
      resultSuccessMsg: "",
    };
  },
  methods: {
    async deleteCarDetails() {
      let formData = new FormData();
      formData.append("ID", this.ID);
      let result = await axios.post(
        "http://sniper/javascript/my-car-vuejs/src/api/cars.php?do=deleteCar",
        formData
      );
      let resultData = result.data;
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
          let res = axios.get(
            "http://sniper/javascript/my-car-vuejs/src/api/cars.php?do=read"
          );
          const resData = res.data;
          this.$emit("updateCars",resData);
          this.hideCurrentModal("deleteCarModal"+this.ID);
        }, 1000);
      }
    },
    hideCurrentModal(id) {
      document.getElementsByTagName("body")[0].removeAttribute("class");
      document.getElementsByTagName("body")[0].removeAttribute("style");

      const elements = document.getElementsByClassName("modal-backdrop");
      while( elements.length > 0 ) elements[0].remove();

      const currentModal = document.getElementsByClassName(id);
      while( currentModal.length > 0 ) currentModal[0].remove();

    }    
  },
};
</script>
