const initialState = () => ({
  globalLoading: false,
  user: {},
  hello:'',
  error: '',
  globalThemes: {
    flatly: "https://bootswatch.com/4/flatly/bootstrap.min.css",
    materia: "https://bootswatch.com/4/materia/bootstrap.min.css",
    solar: "https://bootswatch.com/4/solar/bootstrap.min.css"
},
});
const state = initialState();
export function emptyState() {
  return initialState;
}

export default state;
