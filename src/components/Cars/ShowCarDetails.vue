<template>
  <div
    class="modal fade"
    tabindex="-1"
    :id="'ShowCarDetails' + ID"
    :aria-labelledby="ID"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ Name }}</h5>
          <button
            class="btn-close float-end"
            type="button"
            data-bs-dismiss="modal"
            aria-label="close"
          ></button>
        </div>
        <div class="modal-body">
          <img
            :src="require(`@/assets/cars_image/${Image}`)"
            class="mx-auto d-block rounded img-fluid"
            :alt="Name"
          />
          <h4 class="text-center">{{ Name }} {{ ModelYear }}</h4>
          <hr class="bg-info" />
          <p>Description : {{ Description }}</p>
          <div>
            <button
              class="btn btn-outline-success float-start"
              v-text="convertNumToPrice(Price)"
            ></button>
            <button
              class="btn btn-outline-primary float-end"
              type="button"
              data-bs-dismiss="modal"
              aria-label="close"
            >
              Done readed
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ShowCarDetails",
  props: ["ID", "Name", "ModelYear", "Price", "Description", "Image"],
  methods: {
    convertNumToPrice(num) {
      return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "MRU",
      }).format(num);
    },
  },
};
</script>
