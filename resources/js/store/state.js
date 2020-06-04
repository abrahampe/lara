const initialState = () => ({
  globalLoading: false,
  user: {},
  hello:'',
  error: '',
});
const state = initialState();
export function emptyState() {
  return initialState;
}

export default state;
