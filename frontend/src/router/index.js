import { createRouter, createWebHistory } from "vue-router";
import middlewarePipeline from "../middleware/middlewarePipeline";
import routes from './route';
const router = createRouter({
  history: createWebHistory(import.meta.BASE_URL),
  base: import.meta.BASE_URL,
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return { top: 0 };
    }
  },
});
router.beforeEach((to, from, next) => {
  const titleText = to.name;
  const words = titleText.split(" ");
  const wordslength = words.length;
  // const list_of_module = JSON.parse(localStorage.getItem("modules"));
  for (let i = 0; i < wordslength; i++) {
    words[i] = words[i][0].toUpperCase() + words[i].substr(1);
  }
  var modules = "";
  /** Navigate to next if middleware is not applied */
  if (!to.meta.middleware) {
    return next()
  }
  if(to.params.module != undefined){
    modules = to.params.module+" - ";
  }

  document.title = "IMS | "+modules+  words;

  const middleware = to.meta.middleware;
  const context = { to, from, next }
  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1)
  })
});

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById("loading-bg");
  if (appLoading) {
    appLoading.style.display = "none";
  }
});

export default router;
