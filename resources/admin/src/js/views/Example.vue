<template>
  <section class="wrap">
    <h2 class="mb-1">{{title}}</h2>

    <div class="flex-container align-center">
      <figure>
        <img :src="assets('images/logo.png')" alt="">
      </figure>
    </div>
    <a
      href=""
      download
      class="button button-primary">
      Descargar todo (.xls)
    </a>
    <div class="mb-1">
      <ul class="subsubsub mb-1">
        <li class="all"><a href="admin.php?page=examples">All <span class="count">(0)</span></a> |</li>
        <li class="approved"><a href="admin.php?page=examples&status=approved">Approved <span class="count">(0)</span></a> |</li>
        <li class="rejected"><a href="admin.php?page=examples&status=rejected">Rejected <span class="count">(0)</span></a></li>
        <li class="pending"><a href="admin.php?page=examples&status=pending">Pending <span class="count">(0)</span></a></li>
      </ul>
    </div>
    <table class="widefat fixed mb-1" cellspacing="0">
      <thead>
        <tr>
          <th id="columnname" class="manage-column column-columnname" scope="col">ID</th>
          <th id="columnname" class="manage-column column-columnname" scope="col">Fecha</th>
          <th id="columnname" class="manage-column column-columnname" scope="col">Column 1</th>
          <th id="columnname" class="manage-column column-columnname" scope="col">Column 2</th>
          <th id="columnname" class="manage-column column-columnname" scope="col">Column 3</th>
          <th id="columnname" class="manage-column column-columnname" scope="col">...</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <div class="flex-container align-center">
      <button class="button button-primary">Load more...</button>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      context: {...panda},

      title: 'Example',
    };
  },
};
</script>
