<x-app-layout>
    <div class="py-12 min-h-[calc(100vh-80px)] flex items-center justify-center px-4">
        <div class="max-w-2xl w-full">
            <div class="glass-dark rounded-[2rem] p-8 md:p-12 shadow-2xl relative overflow-hidden backdrop-blur-2xl">
                {{-- Decorative background glows --}}
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl"></div>

                <div class="relative">
                    {{-- Header --}}
                    <div class="flex items-start gap-6 mb-10">
                        <a href="{{ route('product.index') }}" 
                           class="group p-3 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-4xl font-bold text-white tracking-tight mb-2">Edit Product</h1>
                            <p class="text-gray-400 font-medium">
                                Update details for <span class="text-indigo-400">{{ $product->name }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('product.update', $product->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-300 ml-1">
                                Product Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                                   placeholder="Enter product name"
                                   class="w-full px-6 py-4 rounded-2xl bg-slate-900/50 border {{ $errors->has('name') ? 'border-red-500/50' : 'border-white/5' }} focus:border-indigo-500/50 focus:ring-0 text-white placeholder-gray-600 transition-all duration-300">
                            @error('name')
                                <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Quantity & Price --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label for="quantity" class="block text-sm font-semibold text-gray-300 ml-1">
                                    Quantity
                                </label>
                                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                       placeholder="0" min="0"
                                       class="w-full px-6 py-4 rounded-2xl bg-slate-900/50 border {{ $errors->has('quantity') ? 'border-red-500/50' : 'border-white/5' }} focus:border-indigo-500/50 focus:ring-0 text-white placeholder-gray-600 transition-all duration-300">
                                @error('quantity')
                                    <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="price" class="block text-sm font-semibold text-gray-300 ml-1">
                                    Price
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                                       placeholder="0" min="0"
                                       class="w-full px-6 py-4 rounded-2xl bg-slate-900/50 border {{ $errors->has('price') ? 'border-red-500/50' : 'border-white/5' }} focus:border-indigo-500/50 focus:ring-0 text-white placeholder-gray-600 transition-all duration-300">
                                @error('price')
                                    <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- User Selection (Hidden or Styled as per SS if needed, but SS doesn't show it Clearly) --}}
                        <div class="space-y-2">
                            <label for="user_id" class="block text-sm font-semibold text-gray-300 ml-1">
                                Owner
                            </label>
                            <select id="user_id" name="user_id"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-900/50 border {{ $errors->has('user_id') ? 'border-red-500/50' : 'border-white/5' }} focus:border-indigo-500/50 focus:ring-0 text-white transition-all duration-300 appearance-none">
                                <option value="" disabled>Select Owner</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $product->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-6 mt-10 border-t border-white/5">
                            <button type="button" 
                                     onclick="if(confirm('Are you sure you want to delete this product?')) document.getElementById('delete-product-form').submit();"
                                     class="flex items-center gap-2 px-6 py-3 rounded-xl border border-red-500/20 text-red-500 hover:bg-red-500/10 transition-all duration-300 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Product
                             </button>

                             <div class="flex items-center gap-4 w-full md:w-auto">
                                <a href="{{ route('product.index') }}"
                                   class="flex-1 md:flex-none text-center px-8 py-3.5 rounded-2xl bg-white/5 border border-white/10 text-gray-300 font-semibold hover:bg-white/10 transition-all">
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="flex-1 md:flex-none px-10 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-2xl glow-indigo transition-all duration-300">
                                    Update Product
                                </button>
                             </div>
                        </div>
                    </form>

                    <form id="delete-product-form" action="{{ route('product.delete', $product->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
