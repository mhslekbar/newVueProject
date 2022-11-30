<template>
  <div class="container">
    <button @click="goHome()" class="btn btn-primary">Go Home</button>
    <h1 class="text-center">Add New Car</h1>
    <div>
      <form method="POST" enctype="multipart/form-data">

        <div class="row g-3 justify-content-center mb-3">
          <div class="col-auto d-block mc-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carNameErr }"
            >
              <input
                type="text"
                class="form-control w300"
                @input="validateCarName($event)"
                @change="validateCarName($event)"
                id="carShopName"
                placeholder="Car Name"
                v-model.trim="carName"
              />
              <label for="carShopName">Car Name</label>
              <span
                class="error-feedback"
                v-if="carNameErr"
                v-text="carNameMsg"
              ></span>
            </div>
          </div>
        </div>

        <div class="row g-3 justify-content-center mb-3">
          <div class="col-auto d-block mc-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carPriceErr }"
            >
              <input
                type="text"
                class="form-control w300"
                @input="validateCarPrice($event)"
                @change="validateCarPrice($event)"
                id="carShopPrice"
                placeholder="Car Price"
                v-model.trim="carPrice"
              />
              <label for="carShopPrice">Car Price</label>
              <span
                class="error-feedback"
                v-if="carPriceErr"
                v-text="carPriceMsg"
              ></span>
            </div>
          </div>
        </div>

        <div class="row g-3 justify-content-center mb-3">
          <div class="col-auto d-block mc-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carModelYearErr }"
            >
              <input
                type="text"
                class="form-control w300"
                @input="validateCarModelYear($event)"
                @change="validateCarModelYear($event)"
                id="carShopModelYear"
                placeholder="Car ModelYear"
                v-model.trim="carModelYear"
              />
              <label for="carShopModelYear">Car ModelYear</label>
              <span
                class="error-feedback"
                v-if="carModelYearErr"
                v-text="carModelYearMsg"
              ></span>
            </div>
          </div>
        </div>

        <div class="row g-3 justify-content-center mb-3">
          <div class="col-auto d-block mc-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carImageErr }"
              v-if="!image"
            >
              <input
                type="file"
                class="form-control w300 customFileField"
                @input="validateCarImage()"
                @change="validateCarImage()"
                @click="validateCarImage()"
                id="carShopImage"
                placeholder="Car Image"
                ref="carImage"
              />
              <label for="carShopModelYear">Car Image</label>
              <span
                class="error-feedback"
                v-if="carImageErr"
                v-text="carImageMsg"
              ></span>
            </div>
            <div v-else>
              <span>Uploaded Car Image : </span> <br />
              <img :src="image" class="w150 rounded" /> <br />
              <button @click.prevent="removeImg" class="btn btn-outline-danger my-2">Remove Car Image</button>
            </div>
          </div>
        </div>

        <div class="row g-3 justify-content-center mb-3">
          <div class="col-auto d-block mc-auto">
            <div
              class="form-floating"
              :class="{ 'form-data-error': carDescriptionErr }"
            >
              <textarea
                type="text"
                class="form-control w300 h125"
                @keyup="validateCarDescription($event)"
                @change="validateCarDescription($event)"
                id="carShopDescription"
                placeholder="Car Description"
                v-model.trim="carDescription"
              ></textarea>
              <label for="carShopDescription">Car Description</label>
              <span
                class="error-feedback"
                v-if="carDescriptionErr"
                v-text="carDescriptionMsg"
              ></span>
            </div>
          </div>
        </div>

        <div class="row d-grid gap-2 w300 col-auto d-block mx-auto mb-3">
            <button type="submit" @click.prevent="addNewCar" class="btn btn-outline-success">Add New Car</button>
            <button type="reset" @click="resetFormError()" class="btn btn-outline-primary">Reset</button>
        </div>

        <div class="row d-grid gap-2 w300 col-auto d-block mx-auto mb-3">
            <div class="alert alert-success" role="alert" v-text="resultSuccessMsg" v-if="resultSuccess"></div>
            <div class="alert alert-danger" role="alert" v-text="resultErrMsg" v-if="resultErr"></div>
        </div>

      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddNewCar",
  data() {
    return {
        carName: "",
        carNameMsg: "",
        carNameErr: false,
        isCarNameValidated: false,
        carPrice: "",
        carPriceMsg: "",
        carPriceErr: false,
        isCarPriceValidated: false,
        carModelYear: "",
        carModelYearMsg: "",
        carModelYearErr: false,
        isCarModelYearValidated: false,
        carImage: "",
        carImageMsg: "",
        carImageErr: false,
        isCarImageValidated: false,
        carDescription: "",
        carDescriptionMsg: "",
        carDescriptionErr: false,
        isCarDescriptionValidated: false,
        resultSuccess: false,
        resultSuccessMsg: "",
        resultErr: false,
        resultErrMsg: "",
        image: "" 
    };
  },
  methods: {
    goHome() {
      this.$router.push({ name: "Home" });
    },
    validateCarName(e) {
      let val = e.target.value;
      this.validateCarNameInput(val);
    },
    validateCarNameInput(val) {
      if(val == "") {
        this.carNameErr = true;
        this.isCarNameValidated = false;
        this.carNameMsg = "Must Enter Car Name";
      } else if(val != "" && !isNaN(val)) {
        this.carNameErr = true;
        this.isCarNameValidated = false;
        this.carNameMsg = "Car Name Must Be real Text";
      } else if(val.length > 20) {
        this.carNameErr = true;
        this.isCarNameValidated = false;
        this.carNameMsg = "Car Name Must be less than 20 Chars";
      } else {
        this.carNameErr = false;
        this.isCarNameValidated = true;
        this.carNameMsg = "";
      }
    },
    validateCarPrice(e) {
      let val = e.target.value;
      this.validateCarPriceInput(val);
    },
    validateCarPriceInput(val) {
      if(val == "") {
        this.carPriceErr = true;
        this.isCarPriceValidated = false;
        this.carPriceMsg = "Must Enter Car Price";
      } else if(val != "" && isNaN(val)) {
        this.carPriceErr = true;
        this.isCarPriceValidated = false;
        this.carPriceMsg = "Car Price has to be number";
      } else if(val < 0) {
        this.carPriceErr = true;
        this.isCarPriceValidated = false;
        this.carPriceMsg = "Car Price can not be negative";
      } else if(val === 0) {
        this.carPriceErr = true;
        this.isCarPriceValidated = false;
        this.carPriceMsg = "Car Price can not be 0";
      } else {
        this.carPriceErr = false;
        this.isCarPriceValidated = true;
        this.carPriceMsg = "";
      }
    },
    validateCarModelYear(e) {
      let val = e.target.value;
      this.validateCarModelYearInput(val);
    },
    validateCarModelYearInput(val) {
      if(val == "") {
        this.carModelYearErr = true;
        this.isCarModelYearValidated = false;
        this.carModelYearMsg = "Must Enter Car ModelYear";
      } else if(val != "" && isNaN(val)) {
        this.carModelYearErr = true;
        this.isCarModelYearValidated = false;
        this.carModelYearMsg = "Only numbers Ex: 2022";
      } else if(val != "" && val.length != 4) {
        this.carModelYearErr = true;
        this.isCarModelYearValidated = false;
        this.carModelYearMsg = "Enter Valid Year";
      } else {
        this.carModelYearErr = false;
        this.isCarModelYearValidated = true;
        this.carModelYearMsg = "";
      }
    },
    validateCarDescription(e) {
      let val = e.target.value;
      this.validateCarDescriptionInput(val);
    },
    validateCarDescriptionInput(val) {
      if(val == "") {
        this.carDescriptionErr = true;
        this.isCarDescriptionValidated = false;
        this.carDescriptionMsg = "Must Enter Car Description";
      } else if(val != "" && !isNaN(val)) {
        this.carDescriptionErr = true;
        this.isCarDescriptionValidated = false;
        this.carDescriptionMsg = "Car Description Must be real text";
      } else if(val.length > 20) {
        this.carDescriptionErr = true;
        this.isCarDescriptionValidated = false;
        this.carDescriptionMsg = "Car Price must be less than 20 Chars";
      } else {
        this.carDescriptionErr = false;
        this.isCarDescriptionValidated = true;
        this.carDescriptionMsg = "";
      }
    },
    testWord(img) {
      let extn = img.split(".");
      return extn[extn.length - 1];
    },
    validateFileExtension(id) {
      let img = document.getElementById(id);
      let imgPath = img.value.toLowerCase()    // img
      
      let allowedExtension = ["png","jpeg","jpg"];
      if(allowedExtension.includes(this.testWord(imgPath))) {
        return true;
      } else {
        return false;
      }
    },
    createImage(file) {
      new Image();
      let reader = new FileReader();
      reader.onload = (e) => {
        this.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImg() {
      this.image = ""
      setTimeout(() => {
        this.validateCarImage();
      }, 500);
    },
    validateCarImage() {
      if(!this.$refs.carImage.files[0]){
        this.carImageErr = true;
        this.isCarImageValidated = false;
        this.carImageMsg = "Must Select Car Image";

      } else {
        if(this.validateFileExtension("carShopImage")) {
          this.carImageErr = false;
          this.isCarImageValidated = true;
          this.carImageMsg = "";
          this.createImage(this.$refs.carImage.files[0]);
          this.carImage = this.$refs.carImage.files[0];          
        } else {
          this.carImageErr = true;
          this.isCarImageValidated = false;
          this.carImageMsg = "File Not Allowed";  
        }
      }
    },
    async addNewCar() {
      if( this.isCarNameValidated
        &&  this.isCarPriceValidated
        &&  this.isCarModelYearValidated
        &&  this.isCarImageValidated 
        &&  this.isCarDescriptionValidated 
      ) {

        let formData = new FormData();
        formData.append("name", this.carName);
        formData.append("price", this.carPrice);
        formData.append("modelYear", this.carModelYear);
        formData.append("description", this.carDescription);
        formData.append("image", this.carImage);

        let res = await  axios.post("http://sniper/javascript/my-car-vuejs/src/api/cars.php?do=createCar",formData);
        const resultData = res.data;
        if(resultData.status == 200) {
          if(resultData.error) {
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
              this.$router.push({name: "Home"});
            }, 2000);
          }
        }

      } else {
        this.resultErr = true;
        this.resultErrMsg = "Failed, You must added all fields";
        this.resultSuccess = false;
        this.resultSuccessMsg = "";        

        this.validateCarNameInput(this.carName);
        this.validateCarPriceInput(this.carPrice);
        this.validateCarDescriptionInput(this.carDescription);
        this.validateCarModelYearInput(this.carModelYear);
        this.validateCarImage();
      }
    },
    resetFormError() {
      this.carNameErr = false
      this.carNameMsg = ""
      this.carPriceErr = false
      this.carPriceMsg = ""
      this.carImageErr = false
      this.carModelYearMsg = ""
      this.carModelYearErr = false
      this.carImageMsg = ""
      this.carDescriptionErr = false
      this.carDescriptionMsg = ""
      this.resultSuccess = false;
      this.resultSuccessMsg = "";
      this.resultErr = false;
      this.resultErrMsg = "";
    },
  },
};

</script>

<style>
.w300 {
  width: 500px !important;
}
.w150 {
  width: 150px !important;
}
.h125 {
  height: 125px !important;
}
.form-data-error {
  color: #f00;
}
.form-data-error input,
.form-data-error textarea {
  border-color: #f00;
}
.error-feedback {
  padding-left: 3px;
  font-size: 0.9rem;
}
.customFileField {
  padding-left: 24px !important;
  padding-top: 38px !important;
  padding-bottom: 10px !important;
  height: 75px !important;
}
</style>
