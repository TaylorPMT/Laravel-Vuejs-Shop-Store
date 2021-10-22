<template>
  <div>
    <Navbar :title="title"></Navbar>
    <div class="container-fluid my-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title"></h4>
              <p class="card-category">
                <button
                  v-show="show_download"
                  class="btn btn-sm btn-success"
                  @click="dowloadFilm()"
                >
                  {{
                    downloading == true
                      ? "Đang tải vui lòng chờ"
                      : "Bấm để tải xuống"
                  }}
                </button>
              </p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="myTable">
                  <thead class="text-primary">
                    <th>#</th>
                    <th>Tên Phim</th>
                    <th>Chapters</th>
                    <th>Năm Xuất Bản</th>
                    <th>Trạng thái download</th>
                  </thead>
                  <tbody v-if="listFilmPage">
                    <tr v-for="(item, index) in listFilmPage.data" :key="index">
                      <td class="td-center">
                        {{ listFilmPage.from + index }}
                      </td>
                      <td>{{ item.Name }}</td>
                      <td>
                        {{ item.get_chapters.chapters }}
                      </td>
                      <td>{{ item.Year }}</td>
                      <td>
                        <button class="btn btn-sm btn-warning">
                          {{
                            item.status == 0 ? "Chưa tải hết " : "Hoàn thành"
                          }}
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <Paginate
                      :className="''"
                      v-model="pagination"
                      :data="listFilmPage"
                      namePaginate="Danh sách"
                      :classNameSelect="''"
                      :options="options"
                    ></Paginate>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import Navbar from "../../elements/Navbar";
import Paginate from "../../elements/Paginate";
export default {
  name: "Films",
  components: {
    Navbar,
    Paginate,
  },
  data() {
    return {
      title: "Quản lý Phim",
      show_download: true,
      downloading: false,
      pagination: {
        page: 1,
        per_page: 20,
      },
      options: [20, 30, 50],
      filters: {
        key_word: "",
        order_by: "Year",
        sort_by: "desc",
        fields: [],
      },
    };
  },
  computed: {
    ...mapState({
      listFilmPage: (state) => state.Films.LIST_FILM,
    }),
  },
  methods: {
    async getListFilm() {
      let options = {
        ...this.filters,
        fields: this.filters.fields.toString(),
        ...this.pagination,
      };
      let res = await this.$store.dispatch("getListFilm", options);

      return res;
    },
    async dowloadFilm() {
      let res = await this.$store.dispatch("downloadFilm", "download");

      if (res == true) {
        this.downloading = res;
        this.$store.commit("SET_SHOW_POPUP", {
          key: "success",
          text: "Đang tải xuống ",
        });
      } else {
        this.$store.commit("SET_SHOW_POPUP", {
          key: "danger",
          text: "Vui lòng thử lại ",
        });
      }
    },
  },
  async created() {
    await this.getListFilm();
  },

  watch: {
    "pagination.page": async function (val) {
      let vm = this;
      if (val) {
        await vm.getListFilm();
      }
    },
    "pagination.per_page": async function (val) {
      let vm = this;
      if (val) {
        await vm.getListFilm();
      }
    },
  },
};
</script>
