(function () {
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        return;
    }
    const csrfToken = csrfMeta.getAttribute('content');
    const cartCountBadge = document.getElementById('cart-count');
    const productResultsContainer = document.getElementById('product-results');

    function formatRupiah(value) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.max(0, Number(value) || 0));
    }

    function showToast() {
        // Toast dinonaktifkan untuk permintaan ini.
    }

    function updateCartBadge(summary) {
        if (!cartCountBadge || !summary) {
            return;
        }
        const count = summary.items_count ?? summary.total_quantity ?? 0;
        cartCountBadge.dataset.cartCount = count;
        cartCountBadge.textContent = count;
    }

    function formToFetchOptions(form) {
        const formData = new FormData(form);
        return {
            method: form.method || 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
        };
    }

    function handleAddToCart(event) {
        const form = event.target;
        if (!form.classList.contains('js-add-to-cart-form')) {
            return;
        }
        event.preventDefault();

        fetch(form.action, formToFetchOptions(form))
            .then(async (response) => {
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(text || 'Gagal menambahkan produk.');
                }
                return response.json();
            })
            .then((data) => {
                updateCartBadge(data.summary);
                showToast(data.message || 'Produk masuk ke keranjang.');
            })
            .catch((error) => {
                console.error(error);
                form.submit();
            });
    }

    function updateCartRow(itemData) {
        if (!itemData || typeof itemData.id === 'undefined') {
            return;
        }
        const card = document.querySelector(`.store-card[data-item-id="${itemData.id}"]`);
        if (!card) {
            return;
        }
        const qtyInput = card.querySelector('input[name="quantity"]');
        if (qtyInput) {
            qtyInput.value = itemData.quantity;
        }
        const subtotalCell = card.querySelector('.cart-item-subtotal');
        if (subtotalCell) {
            subtotalCell.textContent = formatRupiah(itemData.subtotal ?? itemData.quantity * itemData.price);
        }
        card.dataset.price = itemData.price;
    }

    function handleCartUpdate(event) {
        const form = event.target;
        if (!form.classList.contains('js-cart-update-form')) {
            return;
        }
        event.preventDefault();

        fetch(form.action, formToFetchOptions(form))
            .then(async (response) => {
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(text || 'Gagal memperbarui jumlah.');
                }
                return response.json();
            })
            .then((data) => {
                updateCartBadge(data.summary);
                updateCartRow(data.item);
                document.dispatchEvent(new CustomEvent('cart:refresh'));
                showToast(data.message || 'Jumlah diperbarui.');
            })
            .catch((error) => {
                console.error(error);
                form.submit();
            });
    }

    function handleCartRemove(event) {
        const form = event.target;
        if (!form.classList.contains('js-cart-remove-form')) {
            return;
        }
        event.preventDefault();

        fetch(form.action, formToFetchOptions(form))
            .then(async (response) => {
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(text || 'Gagal menghapus produk.');
                }
                return response.json();
            })
            .then((data) => {
                updateCartBadge(data.summary);
                if (data.removed_id !== undefined) {
                    const card = document.querySelector(`.store-card[data-item-id="${data.removed_id}"]`);
                    if (card) {
                        card.remove();
                    }
                }
                document.dispatchEvent(new CustomEvent('cart:refresh'));
                showToast(data.message || 'Produk dihapus dari keranjang.');
            })
            .catch((error) => {
                console.error(error);
                form.submit();
            });
    }

    function handleRatingSubmit(event) {
        const form = event.target;
        if (!form.classList.contains('js-rating-form')) {
            return;
        }
        event.preventDefault();

        fetch(form.action, formToFetchOptions(form))
            .then(async (response) => {
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(text || 'Gagal menyimpan rating.');
                }
                return response.json();
            })
            .then((data) => {
                if (!data.item) {
                    form.submit();
                    return;
                }
                const wrapper = form.closest('tr');
                const ratingCell = form.closest('td');
                if (ratingCell) {
                    const stars = Array.from({ length: 5 }, (_, idx) => idx + 1)
                        .map((idx) => (idx <= data.item.rating ? '&#9733;' : '&#9734;'))
                        .join('');
                    ratingCell.innerHTML = `
                        <div class="rating-display">
                            <span class="text-warning">${stars}</span>
                            <div class="text-muted small">Diberi rating ${data.item.rating}/5</div>
                            ${data.item.review ? `<p class="text-muted small mb-0 mt-1">"${data.item.review}"</p>` : ''}
                            <small class="text-muted">Dinilai ${data.item.rated_at ?? ''}</small>
                        </div>`;
                }
            })
            .catch((error) => {
                console.error(error);
                form.submit();
            });
    }

    function handleProductFilterSubmit(event) {
        const form = event.target;
        if (!productResultsContainer) {
            return;
        }

        if (form.classList.contains('js-product-filter-form')) {
            event.preventDefault();

            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            const url = `${form.action}?${params.toString()}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    Accept: 'application/json',
                },
            })
                .then(async (response) => {
                    if (!response.ok) {
                        const text = await response.text();
                        throw new Error(text || 'Gagal memuat produk.');
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.html !== undefined) {
                        productResultsContainer.innerHTML = data.html;
                        document.dispatchEvent(new CustomEvent('cart:refresh'));
                    }
                    if (window.history && window.history.replaceState) {
                        window.history.replaceState({}, '', url);
                    }
                })
                .catch((error) => {
                    console.error(error);
                    form.submit();
                });

            return true;
        }

        if (form.classList.contains('search-bar')) {
            // Jalankan AJAX hanya jika sedang berada di halaman katalog (punya container hasil).
            event.preventDefault();
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            const url = `${form.action}?${params.toString()}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    Accept: 'application/json',
                },
            })
                .then(async (response) => {
                    if (!response.ok) {
                        const text = await response.text();
                        throw new Error(text || 'Gagal memuat hasil pencarian.');
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.html !== undefined) {
                        productResultsContainer.innerHTML = data.html;
                        document.dispatchEvent(new CustomEvent('cart:refresh'));
                    }
                    if (window.history && window.history.replaceState) {
                        window.history.replaceState({}, '', url);
                    }
                })
                .catch((error) => {
                    console.error(error);
                    form.submit();
                });

            return true;
        }

        return false;
    }

    document.addEventListener('submit', function (event) {
        if (handleProductFilterSubmit(event)) {
            return;
        }

        if (event.target.classList.contains('js-add-to-cart-form')) {
            handleAddToCart(event);
        } else if (event.target.classList.contains('js-cart-update-form')) {
            handleCartUpdate(event);
        } else if (event.target.classList.contains('js-cart-remove-form')) {
            handleCartRemove(event);
        } else if (event.target.classList.contains('js-rating-form')) {
            handleRatingSubmit(event);
        }
    });
})();
