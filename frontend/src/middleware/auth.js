import { useAuthStore } from "@/store/auth";
export default function auth({ next, store }) {
  const authStore = useAuthStore();  
  const bearerToken = localStorage.getItem("_token");
  if (authStore.authenticated && bearerToken) {
   return next();
  } else {
    return next({ name: "login" });
  }
}
