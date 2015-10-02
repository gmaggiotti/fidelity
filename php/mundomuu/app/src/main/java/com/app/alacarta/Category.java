package com.app.alacarta;

/**
 * Created by gmaggiotti on 5/27/15.
 */
public class Category {
    private String Category;
    private String[] promos;

    public String getCategory() {
        return Category;
    }

    public String[] getPromos() {
        return promos;
    }

    public void setCategory(String category) {
        Category = category;
    }

    public void setPromos(String[] promos) {
        this.promos = promos;
    }
}
