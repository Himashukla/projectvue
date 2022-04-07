<template>
<div>
  <div class="form-group">
    <el-form-item label="Name">
      <el-input placeholder="Enter Name" type="text" v-model="product.name"></el-input>
    </el-form-item>
  </div>
  <div class="form-group">
    <el-form-item label="Price">
      <el-input placeholder="Enter Price" type="text" v-model="product.price"></el-input>
    </el-form-item>
  </div>
  <div class="form-group">
    <div>
      <el-form-item label="Status">
        <el-radio v-model="product.status" label="Active" size="large">Active</el-radio>
        <el-radio v-model="product.status" label="Inactive" size="large">Inactive</el-radio>
     </el-form-item>
    </div>
  </div>
  <div class="form-group">
    <el-upload
      class="upload-demo"
      :on-preview="handlePreview"
      :on-remove="handleRemove"
      :before-remove="beforeRemove"
      multiple
      :limit="3"
      :on-exceed="handleExceed"
      :file-list="fileList"
      v-model="product.picture"
    >
      <el-button type="primary">Click to upload</el-button>
    </el-upload>
  </div>
</div>
</template>

<script>
export default {
  props: {
    product: {
      type: Object,
      default: {},
    },
  }
}
</script>
