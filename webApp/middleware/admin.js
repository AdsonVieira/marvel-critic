export default function ({ store, redirect }) {
  if (store.state.auth.user.is_admin != 1) {
    return redirect('/movies')
  }
}
