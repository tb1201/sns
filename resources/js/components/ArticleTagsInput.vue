<template>
  <div>
    <input
      type="hidden"
      name="tags"
      :value="tagsJson"
    >
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      placeholder="タグを5個まで入力できます"
      :autocomplete-items="filteredItems"
      :add-on-key="[13, 32]"
      @tags-changed="newTags => tags = newTags"
    />
  </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
  components: {
    VueTagsInput,
  },
  props: {
    initialTags: {
      type: Array,
      default: [],
    },
    autocompleteItems: {//タグ補完用
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      tag: '',
      tags: this.initialTags,
    };
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
     tagsJson() {
      return JSON.stringify(this.tags)
    },
  },
};
</script>
<style lang="css" scoped>
  .vue-tags-input {
    max-width: inherit;
  }
</style>
<style lang="css">
  .vue-tags-input .ti-tag {
    background: transparent;
    /*border: 1px solid #747373;*/
    color: #007bff;
    margin-right: 4px;
    border-radius: 0px;
    font-size: 13px;
  }
  .vue-tags-input .ti-tag::before {/*タグの前へ#を表示させる*/
    content: "#";
  }
  .vue-tags-input .ti-icon-close {
    color: #747373;
  }
</style>
